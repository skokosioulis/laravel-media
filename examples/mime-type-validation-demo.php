<?php

/**
 * Laravel Media Package - MIME Type Validation Demo
 *
 * This file demonstrates the fixed MIME type validation functionality.
 * The package now properly validates MIME types using custom validation rules
 * instead of the incorrect 'mimes' rule that was expecting extensions.
 */

// Example 1: Basic MIME type validation in MediaUpload component
/*
The MediaUpload component now uses a custom validation closure that:
1. Checks the actual MIME type of uploaded files
2. Validates against collection-specific allowed MIME types
3. Falls back to global allowed MIME types
4. Provides helpful error messages with readable file type names

Before (incorrect):
return [
    'files.*' => [
        'required',
        'file',
        "max:{$maxSize}",
        "mimes:{$allowedMimes}", // This expected extensions, not MIME types!
    ],
];

After (correct):
return [
    'files.*' => [
        'required',
        'file',
        "max:{$maxSize}",
        function ($attribute, $value, $fail) use ($allowedMimeTypes) {
            if (!empty($allowedMimeTypes) && !in_array($value->getMimeType(), $allowedMimeTypes)) {
                $allowedTypes = implode(', ', array_map(function($type) {
                    return $this->mimeTypeToReadableName($type);
                }, $allowedMimeTypes));
                $fail("The file type '{$value->getMimeType()}' is not allowed. Allowed types: {$allowedTypes}");
            }
        },
    ],
];
*/

// Example 2: Collection-specific MIME type validation
/*
Configuration in config/media.php:

'collections' => [
    'avatars' => [
        'accepts_mime_types' => ['image/jpeg', 'image/png', 'image/webp'],
        'single_file' => true,
    ],
    'documents' => [
        'accepts_mime_types' => [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ],
        'single_file' => false,
    ],
    'gallery' => [
        'accepts_mime_types' => ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
        'single_file' => false,
    ],
],

Usage in Blade:
@livewire('media-upload', [
    'model' => 'App\\Models\\User',
    'modelId' => $user->id,
    'collection' => 'avatars', // Only allows JPEG, PNG, WebP
    'multiple' => false
])
*/

// Example 3: Server-side validation in HasMedia trait
/*
The addMedia() method now validates MIME types before storing:

public function addMedia(UploadedFile $file, string $collection = 'default', array $metadata = []): Media
{
    // Validate MIME type
    if (!Media::isMimeTypeAllowed($file->getMimeType(), $collection)) {
        throw new \InvalidArgumentException(
            "File type '{$file->getMimeType()}' is not allowed for collection '{$collection}'"
        );
    }

    // ... rest of the method
}

This ensures validation happens at both the Livewire component level AND the model level.
*/

// Example 4: Helper methods for MIME type validation
/*
New helper methods in Media model:

// Check if a MIME type is allowed for a collection
Media::isMimeTypeAllowed('image/jpeg', 'avatars'); // true
Media::isMimeTypeAllowed('application/pdf', 'avatars'); // false

// Get allowed MIME types for a collection
Media::getAllowedMimeTypes('avatars'); // ['image/jpeg', 'image/png', 'image/webp']
Media::getAllowedMimeTypes('documents'); // ['application/pdf', 'application/msword', ...]
*/

// Example 5: Improved HTML accept attribute
/*
The getAcceptedTypesFromConfig() method now generates proper accept attributes:

Before: accept="image/jpeg,image/png,application/pdf"
After: accept="image/jpeg,.jpg,.jpeg,image/png,.png,application/pdf,.pdf"

This provides better browser support by including both MIME types and file extensions.
*/

// Example 6: Better error messages
/*
Instead of generic "The files.0 field must be a file of type: image/jpeg,image/png."

You now get: "The file type 'application/x-unknown' is not allowed. Allowed types: JPEG Image, PNG Image, WebP Image"
*/

// Example 7: Usage in your application
/*
// In your controller or wherever you handle file uploads:
try {
    $media = $user->addMedia($uploadedFile, 'avatars');
    return response()->json(['success' => true, 'media' => $media]);
} catch (\InvalidArgumentException $e) {
    return response()->json(['error' => $e->getMessage()], 422);
}

// In your Livewire component:
@livewire('media-upload', [
    'model' => 'App\\Models\\Post',
    'modelId' => $post->id,
    'collection' => 'featured-images',
    'acceptedTypes' => 'image/jpeg,image/png,image/webp', // Optional override
    'maxFileSize' => 5120, // 5MB
    'multiple' => false
])
*/

echo "MIME Type Validation Demo - See comments in this file for examples\n";
echo "The Laravel Media package now properly validates MIME types!\n";
echo "\nKey improvements:\n";
echo "✅ Proper MIME type validation (not file extensions)\n";
echo "✅ Collection-specific MIME type restrictions\n";
echo "✅ Server-side validation in HasMedia trait\n";
echo "✅ Better error messages with readable file type names\n";
echo "✅ Improved HTML accept attributes with both MIME types and extensions\n";
echo "✅ Helper methods for checking allowed MIME types\n";
