# Laravel Media Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/skokosioulis/laravel-media.svg?style=flat-square)](https://packagist.org/packages/skokosioulis/laravel-media)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/skokosioulis/laravel-media/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/skokosioulis/laravel-media/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/skokosioulis/laravel-media/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/skokosioulis/laravel-media/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/skokosioulis/laravel-media.svg?style=flat-square)](https://packagist.org/packages/skokosioulis/laravel-media)

A comprehensive Laravel package for handling file uploads with morphable models, automatic file type detection, and beautiful Livewire components with Alpine.js and Tailwind CSS.

## Features

- 🗂️ **Morphable Media Model** - Attach files to any Eloquent model
- 📁 **Collection Support** - Organize files into collections (avatars, gallery, documents, etc.)
- 🎯 **Automatic Type Detection** - Automatically categorizes files as images, documents, videos, audio, etc.
- 📊 **Rich Metadata Storage** - Stores file size, dimensions, MIME type, checksums, and custom metadata
- 🎨 **Beautiful Livewire Components** - Drag & drop upload interface with real-time preview
- 🔄 **Sortable Media Gallery** - Drag and drop to reorder media files with SortableJS
- 🎭 **Alpine.js Integration** - Smooth interactions and animations
- 🎨 **Tailwind CSS Styling** - Modern, responsive design out of the box
- ✅ **Comprehensive Testing** - Full Pest test coverage
- 🔧 **Highly Configurable** - Extensive configuration options
- 🛡️ **File Validation** - Built-in file type and size validation

## Installation

Install the package via Composer:

```bash
composer require skokosioulis/laravel-media
```

Publish and run the migrations:

```bash
php artisan vendor:publish --tag="laravel-media-migrations"
php artisan migrate
```

Publish the config file:

```bash
php artisan vendor:publish --tag="laravel-media-config"
```

Optionally, publish the views for customization:

```bash
php artisan vendor:publish --tag="laravel-media-views"
```

## Quick Start

### 1. Add the HasMedia trait to your model

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Skokosioulis\LaravelMedia\Traits\HasMedia;

class User extends Model
{
    use HasMedia;
    
    // Your model code...
}
```

### 2. Use in your Blade templates

```blade
{{-- Upload Component --}}
@livewire('media-upload', [
    'model' => 'App\\Models\\User',
    'modelId' => $user->id,
    'collection' => 'avatars',
    'multiple' => false
])

{{-- Gallery Component --}}
@livewire('media-gallery', [
    'model' => 'App\\Models\\User',
    'modelId' => $user->id,
    'collection' => 'gallery',
    'columns' => 4
])

{{-- Sortable Gallery Component --}}
@livewire('sortable-media-gallery', [
    'model' => 'App\\Models\\User',
    'modelId' => $user->id,
    'collection' => 'gallery',
    'columns' => 4
])
```

### 3. Upload files programmatically

```php
$user = User::find(1);

// Upload a file
$media = $user->addMedia($uploadedFile, 'avatars');

// Upload from path
$media = $user->addMediaFromPath('/path/to/file.jpg', 'gallery');

// Get media
$avatars = $user->getMedia('avatars');
$firstAvatar = $user->getFirstMedia('avatars');
$avatarUrl = $user->getFirstMediaUrl('avatars', '/default-avatar.jpg');
```

## Configuration

The package comes with sensible defaults, but you can customize everything:

```php
return [
    'disk' => env('MEDIA_DISK', 'public'),
    'directory' => env('MEDIA_DIRECTORY', 'media'),
    
    'upload_limits' => [
        'max_file_size' => env('MEDIA_MAX_FILE_SIZE', 10240), // KB
        'allowed_mime_types' => [
            'image/jpeg', 'image/png', 'image/gif', 'image/webp',
            'application/pdf', 'video/mp4', 'audio/mpeg',
            // ... more types
        ],
    ],
    
    'collections' => [
        'avatars' => [
            'accepts_mime_types' => ['image/jpeg', 'image/png'],
            'single_file' => true,
        ],
        'gallery' => [
            'accepts_mime_types' => ['image/jpeg', 'image/png', 'image/gif'],
            'single_file' => false,
        ],
    ],
];
```

## Livewire Components

### MediaUpload Component

```blade
@livewire('media-upload', [
    'model' => 'App\\Models\\Post',           // Model class
    'modelId' => $post->id,                  // Model ID
    'collection' => 'featured-images',        // Collection name
    'multiple' => true,                      // Allow multiple files
    'acceptedTypes' => 'image/*',            // Accepted file types
    'maxFileSize' => 5120,                   // Max size in KB
    'showPreview' => true,                   // Show uploaded files preview
    'useDropzone' => true                    // Use dropzone interface (default: true)
])
```

**Interface Options:**
- **Dropzone** (`useDropzone: true`): Drag-and-drop area with visual feedback
- **Button** (`useDropzone: false`): Simple button interface

### SingleMediaUpload Component

Perfect for uploading a single file with automatic replacement functionality:

```blade
@livewire('single-media-upload', [
    'model' => 'App\\Models\\User',          // Model class
    'modelId' => $user->id,                  // Model ID
    'collection' => 'avatar',                // Collection name
    'acceptedTypes' => 'image/*',            // Accepted file types
    'maxFileSize' => 2048,                   // Max size in KB
    'showPreview' => true,                   // Show existing file preview
    'replaceExisting' => true,               // Replace existing file when uploading new one
    'placeholder' => 'Upload your avatar',   // Custom placeholder text
    'useDropzone' => true                    // Use dropzone interface (default: true)
])
```

**Interface Options:**
- **Dropzone** (`useDropzone: true`): Drag-and-drop area with visual feedback
- **Button** (`useDropzone: false`): Simple button interface with "Replace File" when media exists

### MediaGallery Component

```blade
@livewire('media-gallery', [
    'model' => 'App\\Models\\Post',
    'modelId' => $post->id,
    'collection' => 'gallery',
    'columns' => 6,                          // Grid columns
    'showInfo' => true,                      // Show file information
    'sortable' => false                      // Enable sortable mode
])
```

### SortableMediaGallery Component

```blade
@livewire('sortable-media-gallery', [
    'model' => 'App\\Models\\Post',
    'modelId' => $post->id,
    'collection' => 'gallery',
    'columns' => 4,                          // Grid columns
    'showInfo' => true                       // Show file information
])
```

### MediaUpload with Sortable Preview

```blade
@livewire('media-upload', [
    'model' => 'App\\Models\\Post',
    'modelId' => $post->id,
    'collection' => 'gallery',
    'multiple' => true,
    'showPreview' => true,
    'sortablePreview' => true                // Enable sortable preview
])
```

## HasMedia Trait Methods

```php
// Upload files
$media = $model->addMedia($uploadedFile, 'collection');
$media = $model->addMediaFromPath('/path/to/file', 'collection');

// Retrieve media
$allMedia = $model->getMedia('collection');
$firstMedia = $model->getFirstMedia('collection');
$mediaUrl = $model->getFirstMediaUrl('collection', '/default.jpg');

// Check media existence
$hasMedia = $model->hasMedia('collection');

// Clear collection
$model->clearMediaCollection('collection');

// Query media
$images = $model->media()->images()->get();
$documents = $model->media()->documents()->get();
$videos = $model->media()->ofType('video')->get();
$galleryItems = $model->media()->inCollection('gallery')->get();
```

## Media Model Properties

Each media record contains comprehensive metadata:

```php
$media->name;              // Original filename
$media->file_name;         // Stored filename
$media->mime_type;         // MIME type
$media->size;              // File size in bytes
$media->human_readable_size; // "1.5 MB"
$media->type;              // image, video, audio, document, file
$media->url;               // Full URL to file
$media->path;              // Storage path
$media->disk;              // Storage disk
$media->collection_name;   // Collection name
$media->metadata;          // Additional metadata (dimensions, etc.)
$media->alt_text;          // Alt text for accessibility
$media->description;       // File description
$media->checksum;          // File checksum
```

## Testing

Run the test suite:

```bash
composer test
```

The package includes comprehensive Pest tests covering:
- Media model functionality
- HasMedia trait methods
- Livewire component interactions
- File upload validation
- Collection management

## Requirements

- PHP 8.4+
- Laravel 10.0+
- Livewire 3.0+

## Credits

- [Stavros Kokosioulis](https://github.com/skokosioulis)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
