<?php

namespace Skokosioulis\LaravelMedia\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Skokosioulis\LaravelMedia\Models\Media;

class MediaGallery extends Component
{
    public $model;
    public $modelId;
    public $collection = 'default';
    public $columns = 4;
    public $showInfo = true;
    public $sortable = false;
    public $media = [];

    public function mount($model = null, $modelId = null, $collection = 'default', $columns = 4, $showInfo = true, $sortable = false)
    {
        $this->model = $model;
        $this->modelId = $modelId;
        $this->collection = $collection;
        $this->columns = $columns;
        $this->showInfo = $showInfo;
        $this->sortable = $sortable;

        $this->loadMedia();
    }

    public function loadMedia()
    {
        if ($this->model && $this->modelId) {
            $modelClass = $this->model;
            $modelInstance = $modelClass::find($this->modelId);
            
            if ($modelInstance) {
                $this->media = $modelInstance->getMedia($this->collection)->toArray();
            }
        } else {
            // Load all media if no specific model
            $this->media = Media::inCollection($this->collection)->get()->toArray();
        }
    }

    public function removeMedia($mediaId)
    {
        $media = Media::find($mediaId);

        if ($media) {
            $media->delete();
            $this->loadMedia();
            $this->dispatch('media-removed', ['mediaId' => $mediaId]);
        }
    }

    #[On('media-sorted')]
    public function updateMediaOrder($orderedIds)
    {
        foreach ($orderedIds as $index => $mediaId) {
            Media::where('id', $mediaId)->update(['order_column' => $index + 1]);
        }

        $this->loadMedia();
        $this->dispatch('media-reordered', ['collection' => $this->collection]);
    }

    public function render()
    {
        return view('laravel-media::livewire.media-gallery');
    }
}
