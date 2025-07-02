<div class="media-upload-component">
    <!-- Upload Area -->
    <div
        class="upload-area border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors duration-200"
        x-data="{
             isDragging: false,
             handleDrop(e) {
                 this.isDragging = false;
                 const files = Array.from(e.dataTransfer.files);
                 if (files.length > 0) {
                     // Use Livewire's uploadMultiple method for drag and drop
                     window.Livewire.find('<?php echo e($_instance->getId()); ?>').uploadMultiple('files', files);
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
            </div>

            <div>
                <label for="file-upload-<?php echo e($collection); ?>" class="cursor-pointer">
                    <span class="text-sm font-medium text-gray-700">
                        Click to upload <?php echo e($multiple ? 'files' : 'a file'); ?> or drag and drop
                    </span>
                    <input
                        id="file-upload-<?php echo e($collection); ?>"
                        type="file"
                        class="sr-only"
                        wire:model="files"
                        <?php if($multiple): ?> multiple <?php endif; ?>
                        <?php if($acceptedTypes): ?> accept="<?php echo e($acceptedTypes); ?>" <?php endif; ?>
                    >
                </label>
                <p class="text-xs text-gray-500 mt-1">
                    <!--[if BLOCK]><![endif]--><?php if($acceptedTypes): ?>
                        Accepted types: <?php echo e(str_replace(',', ', ', $acceptedTypes)); ?>

                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    Max size: <?php echo e(number_format($maxFileSize / 1024, 1)); ?>MB
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
    <!--[if BLOCK]><![endif]--><?php if($errors->any()): ?>
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
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!-- Existing Media Preview -->
    <!--[if BLOCK]><![endif]--><?php if($showPreview && count($existingMedia) > 0): ?>
        <!--[if BLOCK]><![endif]--><?php if($sortablePreview): ?>
            <ul role="list" class="divide-y divide-gray-100 w-full"
                x-data="sortableUpload()"
                x-init="initSortable()"
                id="sortable-upload-<?php echo e($collection); ?>">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $existingMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li data-id="<?php echo e($media['id']); ?>" class="sortable-item">
                        <?php echo $__env->make('laravel-media::partials.upload-media-item', ['media' => $media, 'sortablePreview' => $sortablePreview], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </ul>
        <?php else: ?>
            <ul role="list" class="divide-y divide-gray-100 w-full">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $existingMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <?php echo $__env->make('laravel-media::partials.upload-media-item', ['media' => $media, 'sortablePreview' => false], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </ul>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if($sortablePreview): ?>
        <!-- Include SortableJS -->
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

        <script>
            function sortableUpload() {
                return {
                    sortable: null,
                    initSortable() {
                        const container = document.getElementById('sortable-upload-<?php echo e($collection); ?>');
                        if (container && typeof Sortable !== 'undefined') {
                            this.sortable = Sortable.create(container, {
                                handle: '.sortable-handle',
                                animation: 150,
                                ghostClass: 'opacity-50',
                                chosenClass: 'scale-105',
                                dragClass: 'rotate-1',
                                onEnd: (evt) => {
                                    const items = Array.from(container.children);
                                    const orderedIds = items.map(item => item.dataset.id);
                                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').call('updateMediaOrder', orderedIds);
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
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\Users\User\Herd\laravel-media\src/../resources/views/livewire/media-upload.blade.php ENDPATH**/ ?>