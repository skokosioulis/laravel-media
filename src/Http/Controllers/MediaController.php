<?php

namespace Skokosioulis\LaravelMedia\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Skokosioulis\LaravelMedia\Models\Media;

class MediaController extends Controller
{
    /**
     * Upload a new media file
     */
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required|file|max:' . config('media.upload_limits.max_file_size', 10240),
        ]);

        try {
            $file = $request->file('file');
            $disk = config('media.disk', 'public');
            $directory = config('media.directory', 'media');

            // Store the file
            $path = $file->store($directory, $disk);
            
            // Create media record
            $media = Media::create([
                'name' => $file->getClientOriginalName(),
                'file_name' => basename($path),
                'mime_type' => $file->getMimeType(),
                'disk' => $disk,
                'path' => $path,
                'size' => $file->getSize(),
                'type' => $this->getFileType($file->getMimeType()),
                'checksum' => md5_file($file->getRealPath()),
                'uuid' => \Illuminate\Support\Str::uuid(),
            ]);

            return response()->json([
                'success' => true,
                'message' => __('media::media.messages.uploaded'),
                'media' => $media,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('media::media.messages.error'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show a specific media file
     */
    public function show(Media $media): JsonResponse
    {
        return response()->json($media);
    }

    /**
     * Update a media file's metadata
     */
    public function update(Request $request, Media $media): JsonResponse
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'alt_text' => 'sometimes|string|max:500',
            'description' => 'sometimes|string|max:1000',
            'collection_name' => 'sometimes|string|max:255',
        ]);

        $media->update($request->only([
            'name', 'alt_text', 'description', 'collection_name'
        ]));

        return response()->json([
            'success' => true,
            'message' => __('media::media.messages.updated'),
            'media' => $media,
        ]);
    }

    /**
     * Delete a media file
     */
    public function destroy(Media $media): JsonResponse
    {
        try {
            // Delete the physical file
            Storage::disk($media->disk)->delete($media->path);
            
            // Delete the database record
            $media->delete();

            return response()->json([
                'success' => true,
                'message' => __('media::media.messages.deleted'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('media::media.messages.error'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Bulk delete media files
     */
    public function bulkDelete(Request $request): JsonResponse
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:media,id',
        ]);

        try {
            $media = Media::whereIn('id', $request->ids)->get();
            
            foreach ($media as $item) {
                Storage::disk($item->disk)->delete($item->path);
                $item->delete();
            }

            return response()->json([
                'success' => true,
                'message' => __('media::media.messages.bulk_deleted', ['count' => $media->count()]),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('media::media.messages.error'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Serve a media file
     */
    public function serve(Media $media): Response
    {
        $path = Storage::disk($media->disk)->path($media->path);
        
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => $media->mime_type,
            'Content-Disposition' => 'inline; filename="' . $media->name . '"',
        ]);
    }

    /**
     * Generate and serve a thumbnail
     */
    public function thumbnail(Media $media, Request $request): Response
    {
        if (!str_starts_with($media->mime_type, 'image/')) {
            abort(404, 'Thumbnails are only available for images');
        }

        $width = $request->get('w', 150);
        $height = $request->get('h', 150);
        
        // This is a simplified example - you might want to use a proper image manipulation library
        $path = Storage::disk($media->disk)->path($media->path);
        
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => $media->mime_type,
        ]);
    }

    /**
     * Determine file type from MIME type
     */
    protected function getFileType(string $mimeType): string
    {
        if (str_starts_with($mimeType, 'image/')) {
            return 'image';
        }
        
        if (str_starts_with($mimeType, 'video/')) {
            return 'video';
        }
        
        if (str_starts_with($mimeType, 'audio/')) {
            return 'audio';
        }
        
        if (str_contains($mimeType, 'pdf')) {
            return 'document';
        }
        
        if (str_contains($mimeType, 'word') || str_contains($mimeType, 'document')) {
            return 'document';
        }
        
        if (str_contains($mimeType, 'sheet') || str_contains($mimeType, 'excel')) {
            return 'spreadsheet';
        }
        
        if (str_contains($mimeType, 'presentation') || str_contains($mimeType, 'powerpoint')) {
            return 'presentation';
        }
        
        return 'file';
    }
}
