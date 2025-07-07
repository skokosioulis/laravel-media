<div class="flex w-full justify-between gap-x-6 py-5 items-center"
     x-data="{
        editingDescription: false,
        description: '<?php echo e($media['description'] ?? ''); ?>',
        originalDescription: '<?php echo e($media['description'] ?? ''); ?>'
    }">
    <!-- Drag Handle (only show if sortable) -->
    <!--[if BLOCK]><![endif]--><?php if ($sortablePreview ?? false) { ?>
        <div
            class="flex-shrink-0 cursor-move sortable-handle opacity-70 hover:opacity-100 transition-opacity duration-200 mr-2">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M7 2a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 2zM7 8a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 8zM7 14a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 14zM13 2a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 2zM13 8a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 8zM13 14a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 14z"></path>
            </svg>
        </div>
    <?php } ?><!--[if ENDBLOCK]><![endif]-->

    <div class="flex min-w-0 w-full gap-x-4 items-center">
        <div class="aspect-square bg-gray-100 rounded-lg">
            <!--[if BLOCK]><![endif]--><?php if ($media['type'] === 'image') { ?>
                <img
                    src="<?php echo e($media['url']); ?>"
                    alt="<?php echo e($media['alt_text'] ?? $media['name']); ?>"
                    class="size-20 flex-none rounded-lg bg-gray-50"
                >
            <?php } elseif ($media['type'] === 'video') { ?>
                <div class="w-full h-full flex items-center justify-center bg-gray-900 cursor-pointer">
                    <div class="text-center text-white">
                        <svg class="w-12 h-12 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm">Video</p>
                    </div>
                </div>
            <?php } else { ?>
                <div class="w-full h-full flex items-center justify-center">
                    <div class="text-center ">
                        <!--[if BLOCK]><![endif]--><?php switch ($media['type']) {
                            case 'document': ?>
                                <svg class="w-9 h-9 text-gray-500 mx-auto mb-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                </svg>
                                <?php break; ?>
                            <?php case 'audio': ?>
                                <svg class="w-10 h-10 text-gray-500 mx-auto mb-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217z" clip-rule="evenodd" />
                                </svg>
                                <?php break; ?>
                            <?php default: ?>
                                <svg class="w-10 h-10 text-gray-500 mx-auto mb-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                </svg>
                        <?php } ?><!--[if ENDBLOCK]><![endif]-->
                        <p class="text-xs text-gray-500 font-medium"><?php echo e(strtoupper($media['type'])); ?> <?php echo e(strtoupper($media['extension'])); ?></p>
                    </div>
                </div>
            <?php } ?><!--[if ENDBLOCK]><![endif]-->
        </div>


        <div class="min-w-0 grow w-full flex-auto items-center  ">
            <div x-cloak>
                <span class="  font-bold truncate text-xs/5  ">  <?php echo e($media['name']); ?>  </span>
                <span class=" truncate text-xs/5 text-gray-500"> <?php echo e($media['human_readable_size']); ?> </span>
            </div>

            <div class="mt-2" x-cloak>
                <div x-show="!editingDescription" class="flex items-center gap-2">
                    <span class="text-sm text-gray-700" x-text="description || 'Enter caption or filename'"></span>
                    <div
                        @click="editingDescription = true; $nextTick(() => $refs.descriptionInput.focus())"
                        class="text-blue-500 hover:cursor-pointer hover:text-blue-700 text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
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
                        class="flex-1 text-sm border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full"
                        placeholder="Enter description..."
                        x-ref="descriptionInput">
                    <div
                        @click="
                            $wire.updateMediaDescription(<?php echo e($media['id']); ?>, description);
                            editingDescription = false;
                            originalDescription = description;
                        "
                        class="text-green-500 hover:text-green-700 text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div
                        @click="
                            description = originalDescription;
                            editingDescription = false;
                        "
                        class="text-red-500 hover:text-red-700 text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="sm:flex sm:flex-col sm:items-end">
        <div
            wire:click="removeFile(<?php echo e($media['id']); ?>)"
            class="border-gray-400 border text-gray-400   rounded-full w-6 h-6 flex items-center justify-center duration-200 hover:bg-red-500 hover:text-white hover:border-red-500 hover:cursor-pointer"
            onclick="return confirm('Are you sure you want to delete this file?')">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
    </div>
</div>

<?php /**PATH C:\Users\User\Herd\laravel-media\src/../resources/views/partials/upload-media-item.blade.php ENDPATH**/ ?>