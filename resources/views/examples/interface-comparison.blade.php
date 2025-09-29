<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Interface Comparison</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Upload Interface Comparison</h1>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Dropzone Interface Examples -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Dropzone Interface</h2>
                    
                    <!-- Multiple Files Upload with Dropzone -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Multiple Files (Dropzone)</h3>
                        <p class="text-sm text-gray-600 mb-4">Drag and drop multiple files or click to select</p>
                        
                        @livewire('media-upload', [
                            'model' => 'App\\Models\\User',
                            'modelId' => 1, // Replace with actual user ID
                            'collection' => 'gallery-dropzone',
                            'multiple' => true,
                            'acceptedTypes' => 'image/*',
                            'maxFileSize' => 5120,
                            'useDropzone' => true
                        ])
                    </div>

                    <!-- Single File Upload with Dropzone -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Single File (Dropzone)</h3>
                        <p class="text-sm text-gray-600 mb-4">Drag and drop or click to upload avatar</p>
                        
                        @livewire('single-media-upload', [
                            'model' => 'App\\Models\\User',
                            'modelId' => 1, // Replace with actual user ID
                            'collection' => 'avatar-dropzone',
                            'acceptedTypes' => 'image/*',
                            'maxFileSize' => 2048,
                            'replaceExisting' => true,
                            'useDropzone' => true,
                            'placeholder' => 'Upload your avatar'
                        ])
                    </div>
                </div>

                <!-- Button Interface Examples -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Button Interface</h2>
                    
                    <!-- Multiple Files Upload with Button -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Multiple Files (Button)</h3>
                        <p class="text-sm text-gray-600 mb-4">Simple button to select multiple files</p>
                        
                        @livewire('media-upload', [
                            'model' => 'App\\Models\\User',
                            'modelId' => 1, // Replace with actual user ID
                            'collection' => 'gallery-button',
                            'multiple' => true,
                            'acceptedTypes' => 'image/*',
                            'maxFileSize' => 5120,
                            'useDropzone' => false
                        ])
                    </div>

                    <!-- Single File Upload with Button -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Single File (Button)</h3>
                        <p class="text-sm text-gray-600 mb-4">Simple button to upload/replace avatar</p>
                        
                        @livewire('single-media-upload', [
                            'model' => 'App\\Models\\User',
                            'modelId' => 1, // Replace with actual user ID
                            'collection' => 'avatar-button',
                            'acceptedTypes' => 'image/*',
                            'maxFileSize' => 2048,
                            'replaceExisting' => true,
                            'useDropzone' => false,
                            'placeholder' => 'Choose Avatar'
                        ])
                    </div>
                </div>
            </div>

            <!-- Comparison Table -->
            <div class="mt-12 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Interface Comparison</h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Feature</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dropzone Interface</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Button Interface</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Drag & Drop</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">✓ Supported</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600">✗ Not available</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Visual Feedback</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">✓ Hover effects, drag states</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-600">~ Button hover only</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Space Usage</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-600">~ Larger area required</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">✓ Compact</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">User Experience</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">✓ Modern, intuitive</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">✓ Familiar, simple</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Mobile Friendly</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-600">~ Limited drag support</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">✓ Excellent</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Best For</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Desktop users, multiple files</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Mobile users, simple uploads</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Code Examples -->
            <div class="mt-12 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Code Examples</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Dropzone Interface</h3>
                        <pre class="bg-gray-100 p-4 rounded-md text-sm overflow-x-auto"><code>@livewire('media-upload', [
    'model' => 'App\\Models\\User',
    'modelId' => $user->id,
    'collection' => 'gallery',
    'useDropzone' => true  // Default
])</code></pre>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Button Interface</h3>
                        <pre class="bg-gray-100 p-4 rounded-md text-sm overflow-x-auto"><code>@livewire('media-upload', [
    'model' => 'App\\Models\\User',
    'modelId' => $user->id,
    'collection' => 'gallery',
    'useDropzone' => false
])</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
    
    <script>
        // Listen for upload events
        document.addEventListener('livewire:init', () => {
            Livewire.on('media-uploaded', (event) => {
                console.log('Media uploaded:', event);
            });
            
            Livewire.on('single-media-uploaded', (event) => {
                console.log('Single media uploaded:', event);
            });
        });
    </script>
</body>
</html>
