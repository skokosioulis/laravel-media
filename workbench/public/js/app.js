// Laravel Media Workbench JavaScript

document.addEventListener('DOMContentLoaded', function() {
    console.log('Laravel Media Workbench loaded');

    // Setup CSRF token for AJAX requests
    setupCSRFToken();

    // Initialize drag and drop functionality
    initializeDragAndDrop();

    // Initialize media gallery
    initializeMediaGallery();
});

function setupCSRFToken() {
    // Set up CSRF token for all AJAX requests
    const token = document.querySelector('meta[name="csrf-token"]');
    if (token) {
        window.Laravel = {
            csrfToken: token.getAttribute('content')
        };

        // Set default headers for fetch requests
        window.fetch = (function(originalFetch) {
            return function(...args) {
                if (args[1] && args[1].method && args[1].method.toUpperCase() !== 'GET') {
                    args[1].headers = args[1].headers || {};
                    args[1].headers['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
                }
                return originalFetch.apply(this, args);
            };
        })(window.fetch);
    }
}

function initializeDragAndDrop() {
    const uploadAreas = document.querySelectorAll('.media-upload-area');
    
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

function initializeMediaGallery() {
    const mediaItems = document.querySelectorAll('.media-item');
    
    mediaItems.forEach(item => {
        item.addEventListener('click', function() {
            // Handle media item selection
            this.classList.toggle('selected');
        });
    });
}

function handleFileUpload(files) {
    console.log('Files dropped:', files);
    
    // This would typically integrate with your Laravel Media package
    // For now, just log the files
    Array.from(files).forEach(file => {
        console.log('File:', file.name, 'Type:', file.type, 'Size:', file.size);
    });
}

// Utility functions for Laravel Media package
window.LaravelMedia = {
    uploadFiles: function(files, options = {}) {
        // Implementation for file upload
        console.log('Uploading files:', files, 'Options:', options);
    },
    
    deleteMedia: function(mediaId) {
        // Implementation for media deletion
        console.log('Deleting media:', mediaId);
    },
    
    sortMedia: function(mediaIds) {
        // Implementation for media sorting
        console.log('Sorting media:', mediaIds);
    }
};
