import 'livewire-sortable';
/**
 * Laravel Media Package JavaScript
 *
 * This file contains utility functions and Alpine.js components
 * for the Laravel Media package.
 */

// Utility functions
window.LaravelMedia = {
    /**
     * Format file size in human readable format
     */
    formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    },

    /**
     * Get file type from MIME type
     */
    getFileType(mimeType) {
        if (mimeType.startsWith('image/')) return 'image';
        if (mimeType.startsWith('video/')) return 'video';
        if (mimeType.startsWith('audio/')) return 'audio';
        if (mimeType.includes('pdf')) return 'pdf';
        if (mimeType.includes('word') || mimeType.includes('document')) return 'document';
        if (mimeType.includes('sheet') || mimeType.includes('excel')) return 'spreadsheet';
        if (mimeType.includes('presentation') || mimeType.includes('powerpoint')) return 'presentation';
        return 'file';
    },

    /**
     * Validate file against allowed types and size
     */
    validateFile(file, allowedTypes = [], maxSize = null) {
        const errors = [];

        // Check file type
        if (allowedTypes.length > 0 && !allowedTypes.includes(file.type)) {
            errors.push(`File type ${file.type} is not allowed`);
        }

        // Check file size
        if (maxSize && file.size > maxSize * 1024) {
            errors.push(`File size exceeds maximum of ${this.formatFileSize(maxSize * 1024)}`);
        }

        return {
            valid: errors.length === 0,
            errors: errors
        };
    },

    /**
     * Create a preview URL for a file
     */
    createPreviewUrl(file) {
        if (file.type.startsWith('image/')) {
            return URL.createObjectURL(file);
        }
        return null;
    }
};

// Alpine.js component for file upload
document.addEventListener('alpine:init', () => {
    Alpine.data('mediaUpload', (config = {}) => ({
        files: [],
        uploading: false,
        progress: 0,
        dragover: false,
        allowedTypes: config.allowedTypes || [],
        maxSize: config.maxSize || null,
        maxFiles: config.maxFiles || null,
        multiple: config.multiple !== false,

        init() {
            // Setup drag and drop
            this.$refs.dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                this.dragover = true;
            });

            this.$refs.dropzone.addEventListener('dragleave', (e) => {
                e.preventDefault();
                this.dragover = false;
            });

            this.$refs.dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                this.dragover = false;
                this.handleFiles(Array.from(e.dataTransfer.files));
            });
        },

        handleFiles(fileList) {
            const newFiles = Array.from(fileList);

            // Check max files limit
            if (this.maxFiles && (this.files.length + newFiles.length) > this.maxFiles) {
                alert(`Maximum ${this.maxFiles} files allowed`);
                return;
            }

            newFiles.forEach(file => {
                const validation = LaravelMedia.validateFile(file, this.allowedTypes, this.maxSize);

                if (validation.valid) {
                    const fileData = {
                        file: file,
                        name: file.name,
                        size: file.size,
                        type: file.type,
                        preview: LaravelMedia.createPreviewUrl(file),
                        uploading: false,
                        uploaded: false,
                        progress: 0,
                        error: null
                    };

                    this.files.push(fileData);
                } else {
                    alert(validation.errors.join('\n'));
                }
            });
        },

        removeFile(index) {
            const file = this.files[index];
            if (file.preview) {
                URL.revokeObjectURL(file.preview);
            }
            this.files.splice(index, 1);
        },

        async uploadFiles() {
            if (this.files.length === 0) return;

            this.uploading = true;

            for (let i = 0; i < this.files.length; i++) {
                const fileData = this.files[i];

                if (fileData.uploaded) continue;

                try {
                    await this.uploadFile(fileData, i);
                } catch (error) {
                    fileData.error = error.message;
                }
            }

            this.uploading = false;
        },

        async uploadFile(fileData, index) {
            const formData = new FormData();
            formData.append('file', fileData.file);

            fileData.uploading = true;

            try {
                const response = await fetch('/media/upload', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (response.ok) {
                    fileData.uploaded = true;
                    fileData.progress = 100;
                    this.$dispatch('file-uploaded', { file: fileData, response: await response.json() });
                } else {
                    throw new Error('Upload failed');
                }
            } catch (error) {
                fileData.error = error.message;
            } finally {
                fileData.uploading = false;
            }
        },

        formatFileSize(bytes) {
            return LaravelMedia.formatFileSize(bytes);
        },

        getFileType(mimeType) {
            return LaravelMedia.getFileType(mimeType);
        }
    }));

    // Alpine.js component for media gallery
    Alpine.data('mediaGallery', (config = {}) => ({
        media: [],
        loading: false,
        selectedItems: [],
        viewMode: config.viewMode || 'grid',

        init() {
            this.loadMedia();
        },

        async loadMedia() {
            this.loading = true;

            try {
                // This would typically fetch from your API
                // const response = await fetch('/media');
                // this.media = await response.json();
            } catch (error) {
                console.error('Failed to load media:', error);
            } finally {
                this.loading = false;
            }
        },

        toggleSelection(mediaId) {
            const index = this.selectedItems.indexOf(mediaId);
            if (index > -1) {
                this.selectedItems.splice(index, 1);
            } else {
                this.selectedItems.push(mediaId);
            }
        },

        selectAll() {
            this.selectedItems = this.media.map(item => item.id);
        },

        deselectAll() {
            this.selectedItems = [];
        },

        async deleteSelected() {
            if (this.selectedItems.length === 0) return;

            if (!confirm(`Delete ${this.selectedItems.length} selected items?`)) return;

            try {
                const response = await fetch('/media/bulk-delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ ids: this.selectedItems })
                });

                if (response.ok) {
                    this.loadMedia();
                    this.selectedItems = [];
                }
            } catch (error) {
                console.error('Failed to delete media:', error);
            }
        }
    }));
});
