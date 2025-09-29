<div class="single-media-upload-component">
    @if($existingMedia && $showPreview)
        <!-- Existing Media Preview -->
        <div class="existing-media-preview mb-4">
            <div class="relative group">
                <div class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                    <!-- Media Thumbnail -->
                    <div class="flex-shrink-0">
                        @if($existingMedia->type === 'image')
                            <img class="w-16 h-16 object-contain rounded-lg bg-gray-100"
                                 src="{{ $existingMedia->url }}"
                                 alt="{{ $existingMedia->alt_text ?? $existingMedia->name }}">
                        @else
                            <div class="w-16 h-16 flex items-center justify-center bg-gray-200 rounded-lg">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Media Info -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $existingMedia->name }}</p>
                                <p class="text-sm text-gray-500">{{ $existingMedia->human_readable_size }}</p>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="mt-2"
                             x-data="{
                                 editingDescription: false,
                                 description: '{{ $existingMedia->description ?? '' }}',
                                 originalDescription: '{{ $existingMedia->description ?? '' }}'
                             }">

                            <!-- Display Description -->
                            <div x-show="!editingDescription" class="flex items-center gap-2">
                                <span class="text-sm text-gray-600"
                                      x-text="description || 'No description'"
                                      :class="{ 'italic text-gray-400': !description }"></span>
                                <button
                                    @click="editingDescription = true; $nextTick(() => $refs.descriptionInput.focus())"
                                    class="text-blue-500 hover:text-blue-700 text-xs">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Edit Description -->
                            <div x-show="editingDescription" class="flex items-center gap-2">
                                <input
                                    type="text"
                                    x-model="description"
                                    @keydown.enter="
                                        $wire.updateMediaDescription(description);
                                        editingDescription = false;
                                        originalDescription = description;
                                    "
                                    @keydown.escape="
                                        description = originalDescription;
                                        editingDescription = false;
                                    "
                                    class="flex-1 text-sm border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Enter description..."
                                    x-ref="descriptionInput">
                                <button
                                    @click="
                                        $wire.updateMediaDescription(description);
                                        editingDescription = false;
                                        originalDescription = description;
                                    "
                                    class="text-green-500 hover:text-green-700 text-xs">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </button>
                                <button
                                    @click="
                                        description = originalDescription;
                                        editingDescription = false;
                                    "
                                    class="text-red-500 hover:text-red-700 text-xs">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Remove Button -->
                    <div class="flex-shrink-0">
                        <button
                            wire:click="removeFile"
                            onclick="return confirm('Are you sure you want to remove this file?')"
                            class="bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Upload Area -->
    @if($useDropzone)
        <!-- Dropzone Interface -->
        <label for="single-file-upload-{{ $collection }}" class="block cursor-pointer">
            <div
                class="upload-area border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors duration-200 {{ $existingMedia && $replaceExisting ? 'border-orange-300 bg-orange-50' : '' }}"
                x-data="{
                     isDragging: false,
                     handleDrop(e) {
                         this.isDragging = false;
                         const files = Array.from(e.dataTransfer.files);
                         if (files.length > 0) {
                             // Only take the first file for single upload
                             @this.upload('file', files[0]);
                         }
                     }
                 }"
                x-on:dragover.prevent="isDragging = true"
                x-on:dragleave.prevent="isDragging = false"
                x-on:drop.prevent="handleDrop($event)"
                :class="{ 'border-blue-400 bg-blue-50': isDragging }">

                <div class="space-y-4">
                    <div class="flex justify-center">
                        @if($existingMedia && $replaceExisting)
                            <svg class="w-12 h-12 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                        @else
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                        @endif
                    </div>

                    <div>
                        <span class="text-sm font-medium text-gray-700">
                            @if($existingMedia && $replaceExisting)
                                {{ $placeholder }} to replace existing file
                            @else
                                {{ $placeholder }}
                            @endif
                        </span>
                        <p class="text-xs text-gray-500 mt-1">
                            Max size: {{ number_format($maxFileSize / 1024, 1) }}MB
                        </p>
                        @if($existingMedia && $replaceExisting)
                            <p class="text-xs text-orange-600 mt-1">
                                <strong>Note:</strong> Uploading a new file will replace the existing one.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <input
                id="single-file-upload-{{ $collection }}"
                type="file"
                class="sr-only"
                wire:model="file"
                @if($acceptedTypes) accept="{{ $acceptedTypes }}" @endif
            >
        </label>
    @else
        <!-- Simple Button Interface -->
        <div class="upload-button-area">
            <div class="flex items-center gap-4">
                <label for="single-file-upload-{{ $collection }}"
                       class="inline-flex items-center px-4 py-2 {{ $existingMedia && $replaceExisting ? 'bg-orange-600 hover:bg-orange-700 focus:bg-orange-700 active:bg-orange-900 focus:ring-orange-500' : 'bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:ring-blue-500' }} border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if($existingMedia && $replaceExisting)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        @endif
                    </svg>
                    @if($existingMedia && $replaceExisting)
                        Replace File
                    @else
                        {{ $placeholder }}
                    @endif
                    <input
                        id="single-file-upload-{{ $collection }}"
                        type="file"
                        class="sr-only"
                        wire:model="file"
                        @if($acceptedTypes) accept="{{ $acceptedTypes }}" @endif
                    >
                </label>

                <div class="text-sm text-gray-600">
                    <span class="block">Max size: {{ number_format($maxFileSize / 1024, 1) }}MB</span>
                    @if($existingMedia && $replaceExisting)
                        <span class="block text-orange-600 font-medium">Will replace existing file</span>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- Upload Progress -->
    <div wire:loading wire:target="file" class="mt-4">
        <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
            <div class="flex items-center">
                <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-600 mr-2"></div>
                <span class="text-sm text-blue-700">Uploading file...</span>
            </div>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mt-4 bg-red-50 border border-red-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                              clip-rule="evenodd"/>
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
</div>
