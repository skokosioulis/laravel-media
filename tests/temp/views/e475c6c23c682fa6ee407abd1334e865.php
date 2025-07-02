<li class="flex w-full justify-between gap-x-6 py-5"
    x-data="{
        editingDescription: false,
        description: '<?php echo e($media['description'] ?? ''); ?>',
        originalDescription: '<?php echo e($media['description'] ?? ''); ?>'
    }">
    <div class="flex min-w-0 gap-x-4">
        <img class="size-12 flex-none rounded-lg bg-gray-50"
             src="<?php echo e($media['url']); ?>" alt="<?php echo e($media['alt_text'] ?? $media['name']); ?>"/>
        <div class="min-w-0 flex-auto">
            <p class="text-sm/6 font-semibold text-gray-900"><?php echo e($media['name']); ?></p>
            <p class="mt-1 truncate text-xs/5 text-gray-500"><?php echo e($media['human_readable_size']); ?></p>

            <!-- Description editing section -->
            <div class="mt-2">
                <div x-show="!editingDescription" class="flex items-center gap-2">
                    <span class="text-sm text-gray-700" x-text="description || 'No description'"></span>
                    <button
                        @click="editingDescription = true; $nextTick(() => $refs.descriptionInput.focus())"
                        class="text-blue-500 hover:text-blue-700 text-xs">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                </div>

                <div x-show="editingDescription" class="flex items-center gap-2">
                    <input
                        type="text"
                        x-model="description"
                        @keydown.enter="
                            $wire.updateMediaDescription(<?php echo e($media['id']); ?>, description);
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
                            $wire.updateMediaDescription(<?php echo e($media['id']); ?>, description);
                            editingDescription = false;
                            originalDescription = description;
                        "
                        class="text-green-500 hover:text-green-700 text-xs">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7"></path>
                        </svg>
                    </button>
                    <button
                        @click="
                            description = originalDescription;
                            editingDescription = false;
                        "
                        class="text-red-500 hover:text-red-700 text-xs">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
        <!--[if BLOCK]><![endif]--><?php if($sortablePreview): ?>
            <div
                x-data="sortableUpload()"
                x-init="initSortable()"
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4"
                id="sortable-upload-<?php echo e($collection); ?>"
            >
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $existingMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div
                        data-id="<?php echo e($media['id']); ?>"
                        class="relative group sortable-item"
                    >
                        <!-- Drag Handle -->
                        <div
                            class="absolute top-1 left-1 z-10 bg-gray-800 bg-opacity-75 text-white p-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-move sortable-handle">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M7 2a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 2zM7 8a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 8zM7 14a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 14zM13 2a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 2zM13 8a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 8zM13 14a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 14z"></path>
                            </svg>
                        </div>
                        <?php echo $__env->make('laravel-media::partials.upload-media-item', ['media' => $media], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <button
            wire:click="removeFile(<?php echo e($media['id']); ?>)"
            class="bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center duration-200 hover:bg-red-600"
            onclick="return confirm('Are you sure you want to delete this file?')">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</li>
<?php /**PATH C:\Users\User\Herd\laravel-media\src/../resources/views/partials/upload-media-item.blade.php ENDPATH**/ ?>