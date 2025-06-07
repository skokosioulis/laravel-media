<div class="media-upload-component">
    <!-- Upload Area -->
    <div class="upload-area border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors duration-200"
         x-data="{ 
             isDragging: false,
             handleDrop(e) {
                 this.isDragging = false;
                 const files = Array.from(e.dataTransfer.files);
                 if (files.length > 0) {
                     @this.set('files', files);
                 }
             }
         }"
         x-on:dragover.prevent="isDragging = true"
         x-on:dragleave.prevent="isDragging = false"
         x-on:drop.prevent="handleDrop($event)"
         :class="{ 'border-blue-400 bg-blue-50': isDragging }">
        
        <div class="space-y-4">
            <div class="flex justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
            </div>
            
            <div>
                <label for="file-upload-{{ $collection }}" class="cursor-pointer">
                    <span class="text-sm font-medium text-gray-700">
                        Click to upload {{ $multiple ? 'files' : 'a file' }} or drag and drop
                    </span>
                    <input 
                        id="file-upload-{{ $collection }}" 
                        type="file" 
                        class="sr-only" 
                        wire:model="files"
                        @if($multiple) multiple @endif
                        @if($acceptedTypes) accept="{{ $acceptedTypes }}" @endif
                    >
                </label>
                <p class="text-xs text-gray-500 mt-1">
                    @if($acceptedTypes)
                        Accepted types: {{ str_replace(',', ', ', $acceptedTypes) }}
                    @endif
                    Max size: {{ number_format($maxFileSize / 1024, 1) }}MB
                </p>
            </div>
        </div>
    </div>

    <!-- Upload Progress -->
    <div wire:loading wire:target="files" class="mt-4">
        <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
            <div class="flex items-center">
                <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-600 mr-2"></div>
                <span class="text-sm text-blue-700">Uploading files...</span>
            </div>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mt-4 bg-red-50 border border-red-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Upload Error</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Existing Media Preview -->
    @if($showPreview && count($existingMedia) > 0)
        <div class="mt-6">
            <div class="flex items-center justify-between mb-3">
                <h4 class="text-sm font-medium text-gray-700">Uploaded Files</h4>
                @if($sortablePreview && count($existingMedia) > 1)
                    <span class="text-xs text-gray-500">Drag to reorder</span>
                @endif
            </div>
            
            @if($sortablePreview)
                <div
                    x-data="sortableUpload()"
                    x-init="initSortable()"
                    class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4"
                    id="sortable-upload-{{ $collection }}"
                >
                    @foreach($existingMedia as $media)
                        <div
                            data-id="{{ $media['id'] }}"
                            class="relative group sortable-item"
                        >
                            <!-- Drag Handle -->
                            <div class="absolute top-1 left-1 z-10 bg-gray-800 bg-opacity-75 text-white p-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-move sortable-handle">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M7 2a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 2zM7 8a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 8zM7 14a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 14zM13 2a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 2zM13 8a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 8zM13 14a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 14z"></path>
                                </svg>
                            </div>
                            @include('laravel-media::partials.upload-media-item', ['media' => $media])
                        </div>
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach($existingMedia as $media)
                        <div class="relative group">
                            @include('laravel-media::partials.upload-media-item', ['media' => $media])
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div>

@if($sortablePreview)
    <!-- Include SortableJS -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <script>
        function sortableUpload() {
            return {
                sortable: null,
                initSortable() {
                    const container = document.getElementById('sortable-upload-{{ $collection }}');
                    if (container && typeof Sortable !== 'undefined') {
                        this.sortable = Sortable.create(container, {
                            handle: '.sortable-handle',
                            animation: 150,
                            ghostClass: 'opacity-50',
                            chosenClass: 'scale-105',
                            onEnd: (evt) => {
                                const items = Array.from(container.children);
                                const orderedIds = items.map(item => item.dataset.id);
                                @this.call('updateMediaOrder', orderedIds);
                            }
                        });
                    }
                },
                destroy() {
                    if (this.sortable) {
                        this.sortable.destroy();
                    }
                }
            }
        }
    </script>
@endif
