<!-- Media Content -->
<div class="aspect-square bg-gray-100">
    <!--[if BLOCK]><![endif]--><?php if ($item['type'] === 'image') { ?>
        <img 
            src="<?php echo e($item['url']); ?>" 
            alt="<?php echo e($item['alt_text'] ?? $item['name']); ?>" 
            class="w-full h-full object-cover cursor-pointer"
            onclick="openMediaModal('<?php echo e($item['url']); ?>', '<?php echo e(addslashes($item['name'])); ?>', '<?php echo e($item['type']); ?>')"
        >
    <?php } elseif ($item['type'] === 'video') { ?>
        <div class="w-full h-full flex items-center justify-center bg-gray-900 cursor-pointer"
             onclick="openMediaModal('<?php echo e($item['url']); ?>', '<?php echo e(addslashes($item['name'])); ?>', '<?php echo e($item['type']); ?>')">
            <div class="text-center text-white">
                <svg class="w-12 h-12 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                </svg>
                <p class="text-sm">Play Video</p>
            </div>
        </div>
    <?php } else { ?>
        <div class="w-full h-full flex items-center justify-center">
            <div class="text-center">
                <!--[if BLOCK]><![endif]--><?php switch ($item['type']) {
                    case 'document': ?>
                        <svg class="w-12 h-12 text-red-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                        </svg>
                        <?php break; ?>
                    <?php case 'audio': ?>
                        <svg class="w-12 h-12 text-green-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217z" clip-rule="evenodd" />
                        </svg>
                        <?php break; ?>
                    <?php default: ?>
                        <svg class="w-12 h-12 text-gray-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                        </svg>
                <?php } ?><!--[if ENDBLOCK]><![endif]-->
                <p class="text-sm text-gray-600 font-medium"><?php echo e(strtoupper($item['type'])); ?></p>
            </div>
        </div>
    <?php } ?><!--[if ENDBLOCK]><![endif]-->
</div>

<!-- Media Info -->
<!--[if BLOCK]><![endif]--><?php if ($showInfo) { ?>
    <div class="p-3">
        <h4 class="text-sm font-medium text-gray-900 truncate" title="<?php echo e($item['name']); ?>">
            <?php echo e($item['name']); ?>

        </h4>
        <div class="mt-1 flex items-center justify-between text-xs text-gray-500">
            <span><?php echo e($item['human_readable_size']); ?></span>
            <span class="capitalize"><?php echo e($item['type']); ?></span>
        </div>
        <!--[if BLOCK]><![endif]--><?php if ($item['description']) { ?>
            <p class="mt-1 text-xs text-gray-600 line-clamp-2"><?php echo e($item['description']); ?></p>
        <?php } ?><!--[if ENDBLOCK]><![endif]-->
    </div>
<?php } ?><!--[if ENDBLOCK]><![endif]-->

<!-- Action Buttons -->
<div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
    <div class="flex space-x-1">
        <!-- Download Button -->
        <a href="<?php echo e($item['url']); ?>" 
           download="<?php echo e($item['name']); ?>"
           class="bg-blue-500 text-white p-1.5 rounded-full hover:bg-blue-600 transition-colors duration-200"
           title="Download">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </a>
        
        <!-- Delete Button -->
        <button 
            wire:click="removeMedia(<?php echo e($item['id']); ?>)"
            onclick="return confirm('Are you sure you want to delete this file?')"
            class="bg-red-500 text-white p-1.5 rounded-full hover:bg-red-600 transition-colors duration-200"
            title="Delete">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </button>
    </div>
</div>
<?php /**PATH C:\Users\User\Herd\laravel-media\src/../resources/views/partials/media-item.blade.php ENDPATH**/ ?>