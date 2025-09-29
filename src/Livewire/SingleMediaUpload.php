<?php

namespace Skokosioulis\LaravelMedia\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Skokosioulis\LaravelMedia\Models\Media;

class SingleMediaUpload extends Component
{
    use WithFileUploads;

    #[Validate]
    public $file;

    public $model;

    public $modelId;

    public $collection = 'default';

    public $acceptedTypes = '';

    public $maxFileSize = 10240; // KB

    public $showPreview = true;

    public $placeholder = 'Click to upload or drag and drop';

    public $replaceExisting = true;

    public $useDropzone = true;

    public $existingMedia = null;

    public function mount($model = null, $modelId = null, $collection = 'default', $acceptedTypes = '', $maxFileSize = null, $showPreview = true, $placeholder = null, $replaceExisting = true, $useDropzone = true)
    {
        $this->model = $model;
        $this->modelId = $modelId;
        $this->collection = $collection;
        $this->acceptedTypes = $acceptedTypes ?: $this->getAcceptedTypesFromConfig();
        $this->maxFileSize = $maxFileSize ?: config('media.upload_limits.max_file_size', 10240);
        $this->showPreview = $showPreview;
        $this->placeholder = $placeholder ?: ($useDropzone ? 'Click to upload or drag and drop' : 'Choose file');
        $this->replaceExisting = $replaceExisting;
        $this->useDropzone = $useDropzone;

        $this->loadExistingMedia();
    }

    public function rules()
    {
        $maxSize = $this->maxFileSize;
        $allowedMimeTypes = $this->getAllowedMimeTypes();

        return [
            'file' => [
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
        return Media::getAllowedMimeTypes($this->collection);
    }

    protected function mimeTypeToReadableName(string $mimeType): string
    {
        $mimeTypeMap = [
            'image/jpeg' => 'JPEG',
            'image/jpg' => 'JPG',
            'image/png' => 'PNG',
            'image/gif' => 'GIF',
            'image/webp' => 'WebP',
            'image/svg+xml' => 'SVG',
            'application/pdf' => 'PDF',
            'text/plain' => 'Text',
            'application/msword' => 'Word',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'Word',
            'application/vnd.ms-excel' => 'Excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'Excel',
        ];

        return $mimeTypeMap[$mimeType] ?? strtoupper(explode('/', $mimeType)[1] ?? 'Unknown');
    }

    protected function mimeTypesToExtensions(array $mimeTypes): array
    {
        $mimeToExtension = [
            'image/jpeg' => 'jpg',
            'image/jpg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
            'image/svg+xml' => 'svg',
            'application/pdf' => 'pdf',
            'text/plain' => 'txt',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/vnd.ms-excel' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
        ];

        return array_values(array_intersect_key($mimeToExtension, array_flip($mimeTypes)));
    }

    public function updatedFile()
    {
        $this->validate();
        if ($this->model && $this->modelId) {
            $this->uploadFile();
        }
    }

    public function uploadFile()
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

        try {
            // If replace existing is enabled, remove existing media first
            if ($this->replaceExisting && $this->existingMedia) {
                $this->existingMedia->delete();
            }

            $media = $modelInstance->addMedia($this->file, $this->collection);

            $this->file = null;
            $this->loadExistingMedia();

            $this->dispatch('single-media-uploaded', [
                'collection' => $this->collection,
                'mediaId' => $media->id,
                'replaced' => $this->replaceExisting && $this->existingMedia !== null,
            ]);
        } catch (\Exception $e) {
            $this->addError('upload', 'Failed to upload file: '.$e->getMessage());
        }
    }

    public function removeFile()
    {
        if ($this->existingMedia) {
            $mediaId = $this->existingMedia->id;
            $this->existingMedia->delete();
            $this->loadExistingMedia();
            $this->dispatch('single-media-removed', ['mediaId' => $mediaId]);
        }
    }

    public function updateMediaDescription($description)
    {
        if (! $this->existingMedia) {
            $this->addError('media', 'No media found to update.');

            return;
        }

        // Check if the media belongs to the current model
        if ($this->existingMedia->mediable_type !== $this->model || $this->existingMedia->mediable_id != $this->modelId) {
            $this->addError('media', 'Unauthorized to update this media.');

            return;
        }

        $this->existingMedia->update(['description' => $description]);

        // Refresh the existing media
        $this->loadExistingMedia();

        $this->dispatch('single-media-description-updated', [
            'mediaId' => $this->existingMedia->id,
            'description' => $description,
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
                $this->existingMedia = $modelInstance->getFirstMedia($this->collection);
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

    public function render()
    {
        return view('laravel-media::livewire.single-media-upload');
    }
}
