<div class="media-gallery">
    <!--[if BLOCK]><![endif]--><?php if (count($media) > 0) { ?>
        <!--[if BLOCK]><![endif]--><?php if ($sortable) { ?>
            <!-- Sortable Mode -->
            <div
                x-data="sortableGallery()"
                x-init="initSortable()"
                class="grid gap-4 <?php switch ($columns) {
                    case 2: ?> grid-cols-2 <?php break; ?>
                    <?php case 3: ?> grid-cols-3 <?php break; ?>
                    <?php case 4: ?> grid-cols-2 md:grid-cols-4 <?php break; ?>
                    <?php case 5: ?> grid-cols-2 md:grid-cols-5 <?php break; ?>
                    <?php case 6: ?> grid-cols-2 md:grid-cols-6 <?php break; ?>
                    <?php default: ?> grid-cols-2 md:grid-cols-4
                <?php } ?>"
                id="sortable-gallery-<?php echo e($collection); ?>"
            >
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $media;
            $__env->addLoop($__currentLoopData);
            foreach ($__currentLoopData as $item) {
                $__env->incrementLoopIndices();
                $loop = $__env->getLastLoop(); ?>
                    <div
                        data-id="<?php echo e($item['id']); ?>"
                        class="relative group bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200 sortable-item"
                    >
                        <!-- Drag Handle -->
                        <div class="absolute top-2 left-2 z-10 bg-gray-800 bg-opacity-75 text-white p-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-move sortable-handle">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 2a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 2zM7 8a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 8zM7 14a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 14zM13 2a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 2zM13 8a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 8zM13 14a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 14z"></path>
                            </svg>
                        </div>

                        <?php echo $__env->make('laravel-media::partials.media-item', ['item' => $item, 'showInfo' => $showInfo], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                <?php } $__env->popLoop();
            $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        <?php } else { ?>
            <!-- Regular Mode -->
            <div class="grid gap-4 <?php switch ($columns) {
                case 2: ?> grid-cols-2 <?php break; ?>
                <?php case 3: ?> grid-cols-3 <?php break; ?>
                <?php case 4: ?> grid-cols-2 md:grid-cols-4 <?php break; ?>
                <?php case 5: ?> grid-cols-2 md:grid-cols-5 <?php break; ?>
                <?php case 6: ?> grid-cols-2 md:grid-cols-6 <?php break; ?>
                <?php default: ?> grid-cols-2 md:grid-cols-4
            <?php } ?>">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $media;
            $__env->addLoop($__currentLoopData);
            foreach ($__currentLoopData as $item) {
                $__env->incrementLoopIndices();
                $loop = $__env->getLastLoop(); ?>
                    <div class="relative group bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <?php echo $__env->make('laravel-media::partials.media-item', ['item' => $item, 'showInfo' => $showInfo], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                <?php } $__env->popLoop();
            $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        <?php } ?><!--[if ENDBLOCK]><![endif]-->
    <?php } else { ?>
        <div class="text-center py-12">
            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No media files</h3>
            <p class="text-gray-500">Upload some files to see them here.</p>
        </div>
    <?php } ?><!--[if ENDBLOCK]><![endif]-->

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

    <!--[if BLOCK]><![endif]--><?php if ($sortable) { ?>
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
    <?php } ?><!--[if ENDBLOCK]><![endif]-->

    <script>
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
<?php /**PATH C:\Users\User\Herd\laravel-media\src/../resources/views/livewire/media-gallery.blade.php ENDPATH**/ ?>