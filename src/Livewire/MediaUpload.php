<?php

namespace Skokosioulis\LaravelMedia\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Skokosioulis\LaravelMedia\Models\Media;

class MediaUpload extends Component
{
    use WithFileUploads;

    #[Validate]
    public $files = [];

    public $model;

    public $modelId;

    public $collection = 'default';

    public $multiple = true;

    public $acceptedTypes = '';

    public $maxFileSize = 10240; // KB

    public $showPreview = true;

    public $sortablePreview = true;

    public $useDropzone = true;

    public $existingMedia = [];

    public function mount($model = null, $modelId = null, $collection = 'default', $multiple = true, $acceptedTypes = '', $maxFileSize = null, $showPreview = true, $sortablePreview = true, $useDropzone = true)
    {
        $this->model = $model;
        $this->modelId = $modelId;
        $this->collection = $collection;
        $this->multiple = $multiple;
        $this->acceptedTypes = $acceptedTypes ?: $this->getAcceptedTypesFromConfig();
        $this->maxFileSize = $maxFileSize ?: config('media.upload_limits.max_file_size', 10240);
        $this->showPreview = $showPreview;
        $this->sortablePreview = $sortablePreview;
        $this->useDropzone = $useDropzone;

        $this->loadExistingMedia();
    }

    public function rules()
    {
        $maxSize = $this->maxFileSize;
        $allowedMimeTypes = $this->getAllowedMimeTypes();

        return [
            'files.*' => [
                'required',
                'file',
                "max:{$maxSize}",
                function ($attribute, $value, $fail) use ($allowedMimeTypes) {
                    if (! empty($allowedMimeTypes) && ! in_array($value->getMimeType(), $allowedMimeTypes)) {
                        $allowedTypes = implode(', ', array_map(function ($type) {
                            return $this->mimeTypeToReadableName($type);
                        }, $allowedMimeTypes));
                        $fail("The file type '{$value->getMimeType()}' is not allowed. Allowed types: {$allowedTypes}");
                    }
                },
            ],
        ];
    }

    protected function getAllowedMimeTypes(): array
    {
        // First check if collection has specific MIME types
        $collectionConfig = config("media.collections.{$this->collection}");
        if ($collectionConfig && isset($collectionConfig['accepts_mime_types']) && ! empty($collectionConfig['accepts_mime_types'])) {
            return $collectionConfig['accepts_mime_types'];
        }

        // Fall back to global allowed MIME types
        return config('media.upload_limits.allowed_mime_types', []);
    }

    protected function mimeTypeToReadableName(string $mimeType): string
    {
        $readableNames = [
            'image/jpeg' => 'JPEG Image',
            'image/png' => 'PNG Image',
            'image/gif' => 'GIF Image',
            'image/webp' => 'WebP Image',
            'image/svg+xml' => 'SVG Image',
            'application/pdf' => 'PDF Document',
            'application/msword' => 'Word Document',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'Word Document (DOCX)',
            'application/vnd.ms-excel' => 'Excel Spreadsheet',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'Excel Spreadsheet (XLSX)',
            'text/plain' => 'Text File',
            'text/csv' => 'CSV File',
            'audio/mpeg' => 'MP3 Audio',
            'audio/wav' => 'WAV Audio',
            'video/mp4' => 'MP4 Video',
            'video/webm' => 'WebM Video',
        ];

        return $readableNames[$mimeType] ?? $mimeType;
    }

    protected function mimeTypesToExtensions(array $mimeTypes): array
    {
        $mimeToExtension = [
            // Images
            'image/jpeg' => 'jpg,jpeg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
            'image/svg+xml' => 'svg',
            'image/bmp' => 'bmp',
            'image/tiff' => 'tiff,tif',

            // Documents
            'application/pdf' => 'pdf',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/vnd.ms-excel' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'application/vnd.ms-powerpoint' => 'ppt',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
            'text/plain' => 'txt',
            'text/csv' => 'csv',
            'application/rtf' => 'rtf',

            // Audio
            'audio/mpeg' => 'mp3',
            'audio/wav' => 'wav',
            'audio/ogg' => 'ogg',
            'audio/mp4' => 'm4a',
            'audio/aac' => 'aac',
            'audio/flac' => 'flac',

            // Video
            'video/mp4' => 'mp4',
            'video/mpeg' => 'mpeg,mpg',
            'video/quicktime' => 'mov',
            'video/webm' => 'webm',
            'video/avi' => 'avi',
            'video/x-msvideo' => 'avi',

            // Archives
            'application/zip' => 'zip',
            'application/x-rar-compressed' => 'rar',
            'application/x-7z-compressed' => '7z',
            'application/x-tar' => 'tar',
            'application/gzip' => 'gz',
        ];

        $extensions = [];
        foreach ($mimeTypes as $mimeType) {
            if (isset($mimeToExtension[$mimeType])) {
                $extensions = array_merge($extensions, explode(',', $mimeToExtension[$mimeType]));
            }
        }

        return array_unique($extensions);
    }

    public function updatedFiles()
    {

        $this->validate();
        if ($this->model && $this->modelId) {
            $this->uploadFiles();
        }
    }

    public function uploadFiles()
    {
        if (! $this->model || ! $this->modelId) {
            $this->addError('upload', 'Model and Model ID are required for upload.');

            return;
        }

        $modelClass = $this->model;

        // Handle both string class names and actual class instances
        if (is_string($modelClass)) {
            // Ensure the class exists
            if (! class_exists($modelClass)) {
                $this->addError('upload', "Model class '{$modelClass}' not found.");

                return;
            }
            $modelInstance = $modelClass::find($this->modelId);
        } else {
            $modelInstance = $modelClass::find($this->modelId);
        }

        if (! $modelInstance) {
            $this->addError('upload', 'Model instance not found.');

            return;
        }

        $uploadedCount = 0;
        foreach ($this->files as $file) {
            try {
                $modelInstance->addMedia($file, $this->collection);
                $uploadedCount++;
            } catch (\Exception $e) {
                $this->addError('upload', 'Failed to upload file: '.$e->getMessage());

                return;
            }
        }

        $this->files = [];
        $this->loadExistingMedia();
        $this->dispatch('media-uploaded', [
            'collection' => $this->collection,
            'count' => $uploadedCount,
        ]);
    }

    public function removeFile($mediaId)
    {
        $media = Media::find($mediaId);

        if ($media) {
            $media->delete();
            $this->loadExistingMedia();
            $this->dispatch('media-removed', ['mediaId' => $mediaId]);
        }
    }

    public function updateTaskOrder($orderedIds)
    {
        // Log the incoming order for debugging
        \Log::info('Updating media order', [
            'collection' => $this->collection,
            'orderedIds' => $orderedIds,
            'model' => $this->model,
            'modelId' => $this->modelId,
        ]);

        // Update the order for media items in this specific collection
        foreach ($orderedIds as $index => $mediaId) {
            // Extract the actual ID from the item
            $mediaId = is_array($mediaId) ? ($mediaId['value'] ?? $mediaId) : $mediaId;

            $updated = Media::where('id', $mediaId)
                ->where('collection_name', $this->collection)
                ->update(['order_column' => $index + 1]);

            \Log::info('Updated media order', [
                'mediaId' => $mediaId,
                'newOrder' => $index + 1,
                'updated' => $updated,
            ]);
        }

        // Reload the media with the new order
        $this->loadExistingMedia();

        // Log the final order for debugging
        \Log::info('Final media order', [
            'existingMedia' => collect($this->existingMedia)->pluck('id', 'order_column')->toArray(),
        ]);

        // Dispatch event for any listeners
        $this->dispatch('media-reordered', [
            'collection' => $this->collection,
            'orderedIds' => $orderedIds,
        ]);
    }

    public function loadExistingMedia()
    {
        if ($this->model && $this->modelId) {
            $modelClass = $this->model;

            // Handle both string class names and actual class instances
            if (is_string($modelClass)) {
                // Ensure the class exists
                if (! class_exists($modelClass)) {
                    $this->addError('model', "Model class '{$modelClass}' not found.");

                    return;
                }
                $modelInstance = $modelClass::find($this->modelId);
            } else {
                $modelInstance = $modelClass::find($this->modelId);
            }

            if ($modelInstance) {
                // Clear any cached relationships to ensure fresh data
                $modelInstance->unsetRelation('media');

                // Get fresh media and ensure they have order values
                $media = $modelInstance->getMedia($this->collection);

                // Initialize order_column for media items that don't have it
                $this->initializeOrderColumn($media);

                // Refresh the media collection to get updated order values
                $freshMedia = Media::whereIn('id', $media->pluck('id'))
                    ->where('collection_name', $this->collection)
                    ->orderBy('order_column', 'asc')
                    ->orderBy('created_at', 'asc') // fallback for items with same order
                    ->get();

                $this->existingMedia = $freshMedia->toArray();

                \Log::info('Loaded existing media', [
                    'collection' => $this->collection,
                    'count' => $freshMedia->count(),
                    'order' => $freshMedia->pluck('id', 'order_column')->toArray(),
                ]);
            }
        }
    }

    /**
     * Initialize order_column for media items that don't have it set
     */
    protected function initializeOrderColumn($media)
    {
        $mediaWithoutOrder = $media->whereNull('order_column');

        if ($mediaWithoutOrder->count() > 0) {
            // Get the highest existing order value
            $maxOrder = $media->whereNotNull('order_column')->max('order_column') ?? 0;

            // Assign order values to media without them
            foreach ($mediaWithoutOrder as $index => $mediaItem) {
                $mediaItem->update(['order_column' => $maxOrder + $index + 1]);
            }
        }
    }

    protected function getAcceptedTypesFromConfig()
    {
        $allowedMimeTypes = $this->getAllowedMimeTypes();

        // Convert MIME types to file extensions for the HTML accept attribute
        $extensions = $this->mimeTypesToExtensions($allowedMimeTypes);

        // Return both MIME types and extensions for better browser support
        $acceptTypes = array_merge($allowedMimeTypes, array_map(function ($ext) {
            return '.'.$ext;
        }, $extensions));

        return implode(',', $acceptTypes);
    }

    public function updateMediaDescription($mediaId, $description)
    {
        $media = Media::find($mediaId);

        if (! $media) {
            $this->addError('media', 'Media not found.');

            return;
        }

        // Check if the media belongs to the current model
        if ($media->mediable_type !== $this->model || $media->mediable_id != $this->modelId) {
            $this->addError('media', 'Unauthorized to update this media.');

            return;
        }

        $media->update(['description' => $description]);

        // Refresh the existing media list
        $this->loadExistingMedia();

        $this->dispatch('media-description-updated', [
            'mediaId' => $mediaId,
            'description' => $description,
        ]);
    }

    public function render()
    {
        return view('laravel-media::livewire.media-upload');
    }
}
