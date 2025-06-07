<?php

// config for Skokosioulis/LaravelMedia
return [
    /*
    |--------------------------------------------------------------------------
    | Default Disk
    |--------------------------------------------------------------------------
    |
    | The default disk to store media files. This should be one of the disks
    | configured in your filesystems.php config file.
    |
    */
    'disk' => env('MEDIA_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Media Directory
    |--------------------------------------------------------------------------
    |
    | The directory where media files will be stored within the disk.
    |
    */
    'directory' => env('MEDIA_DIRECTORY', 'media'),

    /*
    |--------------------------------------------------------------------------
    | Upload Limits
    |--------------------------------------------------------------------------
    |
    | Configure upload limits for different file types.
    |
    */
    'upload_limits' => [
        'max_file_size' => env('MEDIA_MAX_FILE_SIZE', 10240), // KB
        'allowed_mime_types' => [
            // Images
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
            'image/svg+xml',

            // Documents
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'text/plain',
            'text/csv',

            // Audio
            'audio/mpeg',
            'audio/wav',
            'audio/ogg',

            // Video
            'video/mp4',
            'video/mpeg',
            'video/quicktime',
            'video/webm',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Image Processing
    |--------------------------------------------------------------------------
    |
    | Configure image processing options.
    |
    */
    'image_processing' => [
        'generate_thumbnails' => env('MEDIA_GENERATE_THUMBNAILS', true),
        'thumbnail_sizes' => [
            'thumb' => [150, 150],
            'medium' => [300, 300],
            'large' => [800, 600],
        ],
        'quality' => env('MEDIA_IMAGE_QUALITY', 85),
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Collections
    |--------------------------------------------------------------------------
    |
    | Define default collections for organizing media files.
    |
    */
    'collections' => [
        'default' => [
            'accepts_mime_types' => [],
            'single_file' => false,
        ],
        'avatars' => [
            'accepts_mime_types' => ['image/jpeg', 'image/png', 'image/webp'],
            'single_file' => true,
        ],
        'gallery' => [
            'accepts_mime_types' => ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
            'single_file' => false,
        ],
        'documents' => [
            'accepts_mime_types' => [
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            ],
            'single_file' => false,
        ],
    ],
];
