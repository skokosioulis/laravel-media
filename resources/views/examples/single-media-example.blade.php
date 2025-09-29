<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Media Upload Example</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Single Media Upload Examples</h1>

            <!-- Avatar Upload Example -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">User Avatar Upload</h2>
                <p class="text-gray-600 mb-4">
                    This example shows how to use the SingleMediaUpload component for user avatars.
                    When a new avatar is uploaded, it automatically replaces the existing one.
                </p>

                <div class="max-w-md">
                    @livewire('single-media-upload', [
                        'model' => 'App\\Models\\User',
                        'modelId' => 1, // Replace with actual user ID
                        'collection' => 'avatar',
                        'acceptedTypes' => 'image/*',
                        'maxFileSize' => 2048, // 2MB
                        'showPreview' => true,
                        'replaceExisting' => true,
                        'placeholder' => 'Upload your avatar'
                    ])
                </div>
            </div>

            <!-- Profile Cover Upload Example -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Profile Cover Image</h2>
                <p class="text-gray-600 mb-4">
                    Upload a cover image for the user profile. This example allows larger files and shows
                    how to customize the placeholder text.
                </p>

                <div class="max-w-lg">
                    @livewire('single-media-upload', [
                        'model' => 'App\\Models\\User',
                        'modelId' => 1, // Replace with actual user ID
                        'collection' => 'cover',
                        'acceptedTypes' => 'image/jpeg,image/png,image/webp',
                        'maxFileSize' => 5120, // 5MB
                        'showPreview' => true,
                        'replaceExisting' => true,
                        'placeholder' => 'Upload cover image (recommended: 1200x400px)'
                    ])
                </div>
            </div>

            <!-- Document Upload Example -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Document Upload</h2>
                <p class="text-gray-600 mb-4">
                    Upload a single document file. This example shows how to handle non-image files
                    and disable replacement if needed.
                </p>

                <div class="max-w-md">
                    @livewire('single-media-upload', [
                        'model' => 'App\\Models\\User',
                        'modelId' => 1, // Replace with actual user ID
                        'collection' => 'resume',
                        'acceptedTypes' => 'application/pdf,.doc,.docx',
                        'maxFileSize' => 10240, // 10MB
                        'showPreview' => true,
                        'replaceExisting' => false, // Don't replace automatically
                        'placeholder' => 'Upload your resume (PDF or Word document)'
                    ])
                </div>
            </div>

            <!-- Usage Instructions -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-3">Usage Instructions</h3>
                <div class="text-blue-700 space-y-2">
                    <p><strong>Basic Usage:</strong></p>
                    <pre class="bg-blue-100 p-3 rounded text-sm overflow-x-auto"><code>@livewire('single-media-upload', [
    'model' => 'App\\Models\\User',
    'modelId' => $user->id,
    'collection' => 'avatar'
])</code></pre>

                    <p class="mt-4"><strong>Available Parameters:</strong></p>
                    <ul class="list-disc pl-5 space-y-1">
                        <li><code>model</code> - The model class name</li>
                        <li><code>modelId</code> - The model instance ID</li>
                        <li><code>collection</code> - Media collection name (default: 'default')</li>
                        <li><code>acceptedTypes</code> - Accepted file types (default: from config)</li>
                        <li><code>maxFileSize</code> - Maximum file size in KB (default: 10240)</li>
                        <li><code>showPreview</code> - Show existing file preview (default: true)</li>
                        <li><code>replaceExisting</code> - Replace existing file when uploading (default: true)</li>
                        <li><code>placeholder</code> - Custom placeholder text</li>
                        <li><code>useDropzone</code> - Use dropzone interface vs button (default: true)</li>
                    </ul>

                    <p class="mt-4"><strong>Events Dispatched:</strong></p>
                    <ul class="list-disc pl-5 space-y-1">
                        <li><code>single-media-uploaded</code> - When a file is uploaded</li>
                        <li><code>single-media-removed</code> - When a file is removed</li>
                        <li><code>single-media-description-updated</code> - When description is updated</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts

    <script>
        // Listen for upload events
        document.addEventListener('livewire:init', () => {
            Livewire.on('single-media-uploaded', (event) => {
                console.log('Media uploaded:', event);
                // You can add custom logic here, like showing notifications
            });

            Livewire.on('single-media-removed', (event) => {
                console.log('Media removed:', event);
            });

            Livewire.on('single-media-description-updated', (event) => {
                console.log('Description updated:', event);
            });
        });
    </script>
</body>
</html>
