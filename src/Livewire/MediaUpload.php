<?php

namespace Skokosioulis\LaravelMedia\Livewire;

use Illuminate\Support\Facades\Storage;
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
    public $sortablePreview = false;
    public $existingMedia = [];
    
    public function mount($model = null, $modelId = null, $collection = 'default', $multiple = true, $acceptedTypes = '', $maxFileSize = null, $showPreview = true, $sortablePreview = false)
    {
        $this->model = $model;
        $this->modelId = $modelId;
        $this->collection = $collection;
        $this->multiple = $multiple;
        $this->acceptedTypes = $acceptedTypes ?: $this->getAcceptedTypesFromConfig();
        $this->maxFileSize = $maxFileSize ?: config('media.upload_limits.max_file_size', 10240);
        $this->showPreview = $showPreview;
        $this->sortablePreview = $sortablePreview;

        $this->loadExistingMedia();
    }

    public function rules()
    {
        $maxSize = $this->maxFileSize;
        $allowedMimes = implode(',', config('media.upload_limits.allowed_mime_types', []));
        
        return [
            'files.*' => [
                'required',
                'file',
                "max:{$maxSize}",
                "mimes:{$allowedMimes}",
            ],
        ];
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
        if (!$this->model || !$this->modelId) {
            $this->addError('upload', 'Model and Model ID are required for upload.');
            return;
        }

        $modelClass = $this->model;
        $modelInstance = $modelClass::find($this->modelId);

        if (!$modelInstance) {
            $this->addError('upload', 'Model instance not found.');
            return;
        }

        foreach ($this->files as $file) {
            try {
                $modelInstance->addMedia($file, $this->collection);
            } catch (\Exception $e) {
                $this->addError('upload', 'Failed to upload file: ' . $e->getMessage());
                return;
            }
        }

        $this->files = [];
        $this->loadExistingMedia();
        $this->dispatch('media-uploaded', [
            'collection' => $this->collection,
            'count' => count($this->files)
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

    public function updateMediaOrder($orderedIds)
    {
        foreach ($orderedIds as $index => $mediaId) {
            Media::where('id', $mediaId)->update(['order_column' => $index + 1]);
        }

        $this->loadExistingMedia();
        $this->dispatch('media-reordered', ['collection' => $this->collection]);
    }

    public function loadExistingMedia()
    {
        if ($this->model && $this->modelId) {
            $modelClass = $this->model;
            $modelInstance = $modelClass::find($this->modelId);

            if ($modelInstance) {
                $this->existingMedia = $modelInstance->getMedia($this->collection)->toArray();
            }
        }
    }

    protected function getAcceptedTypesFromConfig()
    {
        $collectionConfig = config("media.collections.{$this->collection}");
        
        if ($collectionConfig && isset($collectionConfig['accepts_mime_types'])) {
            return implode(',', $collectionConfig['accepts_mime_types']);
        }
        
        return implode(',', config('media.upload_limits.allowed_mime_types', []));
    }

    public function render()
    {
        return view('laravel-media::livewire.media-upload');
    }
}
