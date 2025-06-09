import './bootstrap';
import Alpine from 'alpinejs';
import Sortable from 'sortablejs';

// Make Alpine available globally
window.Alpine = Alpine;

// Make Sortable available globally
window.Sortable = Sortable;

// Setup CSRF token for AJAX requests
function setupCSRFToken() {
    const token = document.querySelector('meta[name="csrf-token"]');
    if (token) {
        window.Laravel = {
            csrfToken: token.getAttribute('content')
        };
        
        // Set default headers for axios
        if (window.axios) {
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
        }
        
        // Set default headers for fetch requests
        const originalFetch = window.fetch;
        window.fetch = function(...args) {
            if (args[1] && args[1].method && args[1].method.toUpperCase() !== 'GET') {
                args[1].headers = args[1].headers || {};
                args[1].headers['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
            }
            return originalFetch.apply(this, args);
        };
    }
}

// Initialize drag and drop functionality
function initializeDragAndDrop() {
    const uploadAreas = document.querySelectorAll('.upload-area');
    
    uploadAreas.forEach(area => {
        area.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });
        
        area.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });
        
        area.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            handleFileUpload(files);
        });
    });
}

// Handle file upload
function handleFileUpload(files) {
    console.log('Files dropped:', files);
    
    Array.from(files).forEach(file => {
        console.log('File:', file.name, 'Type:', file.type, 'Size:', file.size);
    });
}

// Media modal functions
window.openMediaModal = function(url, name, type) {
    const modal = document.getElementById('mediaModal');
    const content = document.getElementById('modalContent');

    if (type === 'image') {
        content.innerHTML = `<img src="${url}" alt="${name}" class="max-w-full max-h-screen object-contain">`;
    } else if (type === 'video') {
        content.innerHTML = `<video controls class="max-w-full max-h-screen"><source src="${url}" type="video/mp4">Your browser does not support the video tag.</video>`;
    } else {
        content.innerHTML = `<div class="p-8 text-center"><h3 class="text-lg font-medium mb-4">${name}</h3><a href="${url}" target="_blank" class="btn">Open File</a></div>`;
    }

    modal.classList.remove('hidden');
};

window.closeMediaModal = function() {
    document.getElementById('mediaModal').classList.add('hidden');
};

// Alpine.js data functions
window.sortableGallery = function() {
    return {
        sortable: null,
        initSortable() {
            const container = this.$el.querySelector('[id^="sortable-gallery-"]');
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
                        this.$wire.call('updateOrder', orderedIds);
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
};

window.sortableUpload = function() {
    return {
        sortable: null,
        initSortable() {
            const container = this.$el.querySelector('[id^="sortable-upload-"]');
            if (container && typeof Sortable !== 'undefined') {
                this.sortable = Sortable.create(container, {
                    handle: '.sortable-handle',
                    animation: 150,
                    ghostClass: 'opacity-50',
                    chosenClass: 'scale-105',
                    onEnd: (evt) => {
                        const items = Array.from(container.children);
                        const orderedIds = items.map(item => item.dataset.id);
                        this.$wire.call('updateMediaOrder', orderedIds);
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
};

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('Laravel Media Workbench loaded');
    
    // Setup CSRF token
    setupCSRFToken();
    
    // Initialize drag and drop
    initializeDragAndDrop();
    
    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMediaModal();
        }
    });
});

// Start Alpine
Alpine.start();
