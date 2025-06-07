<?php

namespace Skokosioulis\LaravelMedia\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Skokosioulis\LaravelMedia\Models\Media;

trait HasMedia
{
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')->orderBy('order_column');
    }

    public function getMedia(string $collection = 'default')
    {
        return $this->media()->inCollection($collection)->get();
    }

    public function getFirstMedia(string $collection = 'default'): ?Media
    {
        return $this->media()->inCollection($collection)->first();
    }

    public function getFirstMediaUrl(string $collection = 'default', string $default = ''): string
    {
        $media = $this->getFirstMedia($collection);

        return $media ? $media->url : $default;
    }

    public function addMedia(UploadedFile $file, string $collection = 'default', array $metadata = []): Media
    {
        // Validate MIME type
        if (! Media::isMimeTypeAllowed($file->getMimeType(), $collection)) {
            throw new \InvalidArgumentException(
                "File type '{$file->getMimeType()}' is not allowed for collection '{$collection}'"
            );
        }

        $disk = config('media.disk', 'public');
        $directory = config('media.directory', 'media');

        // Generate unique filename
        $fileName = $this->generateUniqueFileName($file);
        $path = $directory.'/'.$fileName;

        // Store the file
        $storedPath = $file->storeAs($directory, $fileName, $disk);

        // Calculate checksum
        $checksum = md5_file($file->getRealPath());

        // Determine file type
        $type = $this->determineFileType($file->getMimeType());

        // Get file metadata
        $fileMetadata = $this->extractFileMetadata($file, $metadata);

        // Get next order column
        $orderColumn = $this->getNextOrderColumn($collection);

        return $this->media()->create([
            'name' => $file->getClientOriginalName(),
            'file_name' => $fileName,
            'mime_type' => $file->getMimeType(),
            'disk' => $disk,
            'path' => $storedPath,
            'size' => $file->getSize(),
            'type' => $type,
            'metadata' => $fileMetadata,
            'collection_name' => $collection,
            'order_column' => $orderColumn,
            'checksum' => $checksum,
        ]);
    }

    public function addMediaFromPath(string $path, string $collection = 'default', array $metadata = []): Media
    {
        $disk = config('media.disk', 'public');
        $directory = config('media.directory', 'media');

        if (! file_exists($path)) {
            throw new \InvalidArgumentException("File does not exist at path: {$path}");
        }

        $originalName = basename($path);
        $mimeType = mime_content_type($path);
        $size = filesize($path);

        // Validate MIME type
        if (! Media::isMimeTypeAllowed($mimeType, $collection)) {
            throw new \InvalidArgumentException(
                "File type '{$mimeType}' is not allowed for collection '{$collection}'"
            );
        }

        // Generate unique filename
        $fileName = $this->generateUniqueFileNameFromPath($path);
        $storedPath = $directory.'/'.$fileName;

        // Copy file to storage
        Storage::disk($disk)->put($storedPath, file_get_contents($path));

        // Calculate checksum
        $checksum = md5_file($path);

        // Determine file type
        $type = $this->determineFileType($mimeType);

        // Get next order column
        $orderColumn = $this->getNextOrderColumn($collection);

        return $this->media()->create([
            'name' => $originalName,
            'file_name' => $fileName,
            'mime_type' => $mimeType,
            'disk' => $disk,
            'path' => $storedPath,
            'size' => $size,
            'type' => $type,
            'metadata' => $metadata,
            'collection_name' => $collection,
            'order_column' => $orderColumn,
            'checksum' => $checksum,
        ]);
    }

    public function clearMediaCollection(string $collection = 'default'): void
    {
        $this->getMedia($collection)->each(function (Media $media) {
            $media->delete();
        });
    }

    public function hasMedia(string $collection = 'default'): bool
    {
        return $this->getMedia($collection)->isNotEmpty();
    }

    protected function generateUniqueFileName(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $slug = Str::slug($name);

        return $slug.'-'.time().'-'.Str::random(8).'.'.$extension;
    }

    protected function generateUniqueFileNameFromPath(string $path): string
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $name = pathinfo($path, PATHINFO_FILENAME);
        $slug = Str::slug($name);

        return $slug.'-'.time().'-'.Str::random(8).'.'.$extension;
    }

    protected function determineFileType(string $mimeType): string
    {
        if (Str::startsWith($mimeType, 'image/')) {
            return 'image';
        }

        if (Str::startsWith($mimeType, 'video/')) {
            return 'video';
        }

        if (Str::startsWith($mimeType, 'audio/')) {
            return 'audio';
        }

        $documentMimes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'text/plain',
        ];

        if (in_array($mimeType, $documentMimes)) {
            return 'document';
        }

        return 'file';
    }

    protected function extractFileMetadata(UploadedFile $file, array $additionalMetadata = []): array
    {
        $metadata = $additionalMetadata;

        // Extract image dimensions if it's an image
        if (Str::startsWith($file->getMimeType(), 'image/')) {
            $imageInfo = getimagesize($file->getRealPath());
            if ($imageInfo) {
                $metadata['width'] = $imageInfo[0];
                $metadata['height'] = $imageInfo[1];
            }
        }

        return $metadata;
    }

    protected function getNextOrderColumn(string $collection): int
    {
        $lastMedia = $this->media()->inCollection($collection)->orderBy('order_column', 'desc')->first();

        return $lastMedia ? $lastMedia->order_column + 1 : 1;
    }
}
