<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livewire Sortable Debug</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Livewire Sortable Debug</h1>

            <!-- Debug Information -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Debug Information</h2>

                <div class="space-y-4">
                    <div>
                        <h3 class="font-medium text-gray-700">JavaScript Console</h3>
                        <p class="text-sm text-gray-600">Open browser console (F12) to check for errors</p>
                    </div>

                    <div>
                        <h3 class="font-medium text-gray-700">Livewire Version</h3>
                        <p class="text-sm text-gray-600">Check if Livewire is loaded: <code id="livewire-check" class="bg-gray-100 px-1 rounded">Checking...</code></p>
                    </div>

                    <div>
                        <h3 class="font-medium text-gray-700">Sortable Plugin</h3>
                        <p class="text-sm text-gray-600">Check if sortable is loaded: <code id="sortable-check" class="bg-gray-100 px-1 rounded">Checking...</code></p>
                    </div>
                </div>
            </div>

            <!-- Simple Sortable Test -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Simple Sortable Test</h2>
                <p class="text-gray-600 mb-4">Try dragging the items below:</p>

                @livewire('sortable-test')
            </div>

            <!-- Media Upload Test -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Media Upload Sortable Test</h2>
                <p class="text-gray-600 mb-4">Upload some files and try sorting them:</p>

                @livewire('media-upload', [
                    'model' => 'App\\Models\\User',
                    'modelId' => 1,
                    'collection' => 'debug-test',
                    'multiple' => true,
                    'acceptedTypes' => 'image/*',
                    'maxFileSize' => 5120,
                    'sortablePreview' => true,
                    'useDropzone' => true
                ])
            </div>
        </div>
    </div>

    @livewireScripts

    <!-- Livewire Sortable Script -->
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>

    <!-- Stack for component scripts -->
    @stack('scripts')

    <!-- Debug Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check Livewire
            const livewireCheck = document.getElementById('livewire-check');
            if (typeof window.Livewire !== 'undefined') {
                livewireCheck.textContent = '✅ Livewire loaded';
                livewireCheck.className = 'bg-green-100 text-green-800 px-1 rounded';
            } else {
                livewireCheck.textContent = '❌ Livewire not found';
                livewireCheck.className = 'bg-red-100 text-red-800 px-1 rounded';
            }

            // Check Sortable
            const sortableCheck = document.getElementById('sortable-check');
            // Wait a bit for scripts to load
            setTimeout(() => {
                if (typeof window.livewireSortable !== 'undefined' || document.querySelector('[wire\\:sortable]')) {
                    sortableCheck.textContent = '✅ Sortable plugin detected';
                    sortableCheck.className = 'bg-green-100 text-green-800 px-1 rounded';
                } else {
                    sortableCheck.textContent = '❌ Sortable plugin not found';
                    sortableCheck.className = 'bg-red-100 text-red-800 px-1 rounded';
                }
            }, 1000);
        });

        // Listen for Livewire events
        document.addEventListener('livewire:init', () => {
            console.log('Livewire initialized');

            Livewire.on('media-reordered', (event) => {
                console.log('Media reordered:', event);
            });

            Livewire.on('test-reordered', (event) => {
                console.log('Test items reordered:', event);
            });
        });

        // Log any JavaScript errors
        window.addEventListener('error', function(e) {
            console.error('JavaScript Error:', e.error);
        });
    </script>
</body>
</html>
