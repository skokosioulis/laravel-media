<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Media Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the Laravel Media package.
    | You are free to modify these language lines according to your
    | application's requirements.
    |
    */

    'upload' => [
        'title' => 'Upload Media',
        'drag_drop' => 'Drag and drop files here or click to browse',
        'browse' => 'Browse Files',
        'uploading' => 'Uploading...',
        'success' => 'File uploaded successfully',
        'error' => 'Upload failed',
        'max_files' => 'Maximum :max files allowed',
        'max_size' => 'Maximum file size: :size',
        'invalid_type' => 'Invalid file type',
        'remove' => 'Remove',
        'retry' => 'Retry',
    ],

    'gallery' => [
        'title' => 'Media Gallery',
        'empty' => 'No media files found',
        'loading' => 'Loading...',
        'view' => 'View',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'download' => 'Download',
        'select' => 'Select',
        'selected' => 'Selected',
        'select_all' => 'Select All',
        'deselect_all' => 'Deselect All',
    ],

    'actions' => [
        'save' => 'Save',
        'cancel' => 'Cancel',
        'delete' => 'Delete',
        'confirm_delete' => 'Are you sure you want to delete this media?',
        'bulk_delete' => 'Delete Selected',
        'confirm_bulk_delete' => 'Are you sure you want to delete :count selected media files?',
    ],

    'properties' => [
        'name' => 'Name',
        'file_name' => 'File Name',
        'size' => 'Size',
        'type' => 'Type',
        'mime_type' => 'MIME Type',
        'dimensions' => 'Dimensions',
        'created_at' => 'Created',
        'updated_at' => 'Updated',
        'alt_text' => 'Alt Text',
        'description' => 'Description',
        'collection' => 'Collection',
    ],

    'collections' => [
        'default' => 'Default',
        'avatars' => 'Avatars',
        'gallery' => 'Gallery',
        'documents' => 'Documents',
    ],

    'validation' => [
        'required' => 'Please select a file',
        'max_size' => 'File size must not exceed :max KB',
        'mime_types' => 'File type not allowed. Allowed types: :types',
        'max_files' => 'You can only upload :max files at once',
    ],

    'messages' => [
        'uploaded' => 'Media uploaded successfully',
        'updated' => 'Media updated successfully',
        'deleted' => 'Media deleted successfully',
        'bulk_deleted' => ':count media files deleted successfully',
        'error' => 'An error occurred while processing your request',
        'not_found' => 'Media not found',
        'permission_denied' => 'You do not have permission to perform this action',
    ],
];
