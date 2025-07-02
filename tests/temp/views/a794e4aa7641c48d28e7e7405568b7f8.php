<div class="sortable-media-gallery">
    <!-- Main Gallery Content -->
    <div class="gallery-content">
        <!--[if BLOCK]><![endif]--><?php if(count($media) > 0): ?>
            <div class="mb-4 flex items-center justify-between">
                <h4 class="text-sm font-medium text-gray-700">Drag and drop to reorder</h4>
                <div class="text-xs text-gray-500"><?php echo e(count($media)); ?> files</div>
            </div>

            <div
                x-data="sortableGallery()"
                x-init="initSortable()"
                class="grid gap-4 <?php switch($columns):
                    case (2): ?> grid-cols-2 <?php break; ?>
                    <?php case (3): ?> grid-cols-3 <?php break; ?>
                    <?php case (4): ?> grid-cols-2 md:grid-cols-4 <?php break; ?>
                    <?php case (5): ?> grid-cols-2 md:grid-cols-5 <?php break; ?>
                    <?php case (6): ?> grid-cols-2 md:grid-cols-6 <?php break; ?>
                    <?php default: ?> grid-cols-2 md:grid-cols-4
                <?php endswitch; ?>"
                id="sortable-gallery-<?php echo e($collection); ?>"
            >
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div
                    data-id="<?php echo e($item['id']); ?>"
                    class="relative group bg-white rounded-lg shadow-sm border-2 border-dashed border-gray-300 overflow-hidden hover:shadow-md hover:border-blue-400 transition-all duration-200 sortable-item"
                >
                    <!-- Drag Handle -->
                    <div class="absolute top-2 left-2 z-20 bg-gray-800 bg-opacity-90 text-white p-2 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-grab active:cursor-grabbing sortable-handle">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M7 2a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 2zM7 8a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 8zM7 14a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 14zM13 2a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 2zM13 8a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 8zM13 14a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 14z"></path>
                        </svg>
                    </div>

                    <!-- Order Number -->
                    <div class="absolute top-2 right-2 z-20 bg-blue-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                        <?php echo e($item['order_column'] ?? $loop->iteration); ?>

                    </div>

                    <!-- Media Content -->
                    <div class="aspect-square bg-gray-100 relative">
                        <!--[if BLOCK]><![endif]--><?php if($item['type'] === 'image'): ?>
                            <img 
                                src="<?php echo e($item['url']); ?>" 
                                alt="<?php echo e($item['alt_text'] ?? $item['name']); ?>" 
                                class="w-full h-full object-cover"
                            >
                            <!-- Image Overlay -->
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-200 flex items-center justify-center">
                                <button 
                                    onclick="openMediaModal('<?php echo e($item['url']); ?>', '<?php echo e(addslashes($item['name'])); ?>', '<?php echo e($item['type']); ?>')"
                                    class="bg-white bg-opacity-90 text-gray-800 p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-opacity-100"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        <?php elseif($item['type'] === 'video'): ?>
                            <div class="w-full h-full flex items-center justify-center bg-gray-900">
                                <div class="text-center text-white">
                                    <svg class="w-12 h-12 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-sm">Video</p>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="text-center">
                                    <!--[if BLOCK]><![endif]--><?php switch($item['type']):
                                        case ('document'): ?>
                                            <svg class="w-12 h-12 text-red-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                            </svg>
                                            <?php break; ?>
                                        <?php case ('audio'): ?>
                                            <svg class="w-12 h-12 text-green-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217z" clip-rule="evenodd" />
                                            </svg>
                                            <?php break; ?>
                                        <?php default: ?>
                                            <svg class="w-12 h-12 text-gray-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                            </svg>
                                    <?php endswitch; ?><!--[if ENDBLOCK]><![endif]-->
                                    <p class="text-sm text-gray-600 font-medium"><?php echo e(strtoupper($item['type'])); ?></p>
                                </div>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <!-- Media Info -->
                    <!--[if BLOCK]><![endif]--><?php if($showInfo): ?>
                        <div class="p-3 bg-white">
                            <h4 class="text-sm font-medium text-gray-900 truncate" title="<?php echo e($item['name']); ?>">
                                <?php echo e($item['name']); ?>

                            </h4>
                            <div class="mt-1 flex items-center justify-between text-xs text-gray-500">
                                <span><?php echo e($item['human_readable_size']); ?></span>
                                <span class="capitalize"><?php echo e($item['type']); ?></span>
                            </div>
                            <!--[if BLOCK]><![endif]--><?php if($item['description']): ?>
                                <p class="mt-1 text-xs text-gray-600 line-clamp-2"><?php echo e($item['description']); ?></p>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <!-- Action Buttons -->
                    <div class="absolute bottom-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
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
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No media files</h3>
                <p class="text-gray-500">Upload some files to see them here.</p>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <!-- Media Modal -->
    <div id="mediaModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeMediaModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div id="modalContent" class="bg-white rounded-lg overflow-hidden"></div>
        </div>
    </div>

    <!-- Include SortableJS -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <script>
    function sortableGallery() {
        return {
            sortable: null,
            initSortable() {
                const container = document.getElementById('sortable-gallery-<?php echo e($collection); ?>');
                if (container && typeof Sortable !== 'undefined') {
                    this.sortable = Sortable.create(container, {
                        handle: '.sortable-handle',
                        animation: 150,
                        ghostClass: 'opacity-50',
                        chosenClass: 'scale-105',
                        dragClass: 'rotate-3',
                        onEnd: (evt) => {
                            const items = Array.from(container.children);
                            const orderedIds = items.map(item => item.dataset.id);
                            window.Livewire.find('<?php echo e($_instance->getId()); ?>').call('updateOrder', orderedIds);
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

    function openMediaModal(url, name, type) {
        const modal = document.getElementById('mediaModal');
        const content = document.getElementById('modalContent');

        if (type === 'image') {
            content.innerHTML = `<img src="${url}" alt="${name}" class="max-w-full max-h-screen object-contain">`;
        } else if (type === 'video') {
            content.innerHTML = `<video controls class="max-w-full max-h-screen"><source src="${url}" type="video/mp4">Your browser does not support the video tag.</video>`;
        } else {
            content.innerHTML = `<div class="p-8 text-center"><h3 class="text-lg font-medium mb-4">${name}</h3><a href="${url}" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Open File</a></div>`;
        }

        modal.classList.remove('hidden');
    }

    function closeMediaModal() {
        document.getElementById('mediaModal').classList.add('hidden');
    }

    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMediaModal();
        }
    });
    </script>
</div>
<?php /**PATH C:\Users\User\Herd\laravel-media\src/../resources/views/livewire/sortable-media-gallery.blade.php ENDPATH**/ ?>