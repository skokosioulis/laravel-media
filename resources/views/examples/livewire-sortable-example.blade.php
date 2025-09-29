<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livewire Sortable Media Upload Example</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Livewire Sortable Media Upload</h1>

            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Migration from SortableJS to Livewire Sortable</h2>

                <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-6">
                    <h3 class="text-lg font-medium text-blue-800 mb-2">✅ What Changed</h3>
                    <ul class="list-disc pl-5 space-y-1 text-blue-700">
                        <li><strong>Removed SortableJS dependency</strong> - No more external JavaScript library</li>
                        <li><strong>Added Livewire Sortable</strong> - Native Livewire sorting functionality</li>
                        <li><strong>Simplified implementation</strong> - Less JavaScript, more Livewire magic</li>
                        <li><strong>Better performance</strong> - Reduced bundle size and faster loading</li>
                        <li><strong>Improved maintainability</strong> - All sorting logic in Livewire components</li>
                    </ul>
                </div>

                <div class="bg-green-50 border border-green-200 rounded-md p-4 mb-6">
                    <h3 class="text-lg font-medium text-green-800 mb-2">🚀 Benefits</h3>
                    <ul class="list-disc pl-5 space-y-1 text-green-700">
                        <li><strong>No CDN dependencies</strong> - Everything is self-contained</li>
                        <li><strong>Better integration</strong> - Native Livewire component communication</li>
                        <li><strong>Consistent styling</strong> - Uses Tailwind CSS classes throughout</li>
                        <li><strong>Touch-friendly</strong> - Works great on mobile devices</li>
                        <li><strong>Accessibility</strong> - Better keyboard navigation support</li>
                    </ul>
                </div>
            </div>

            <!-- Example Implementation -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Live Example</h2>
                <p class="text-gray-600 mb-6">Upload some files and then drag the handle (⋮⋮) to reorder them.</p>

                @livewire('media-upload', [
                    'model' => 'App\\Models\\User',
                    'modelId' => 1, // Replace with actual user ID
                    'collection' => 'sortable-demo',
                    'multiple' => true,
                    'acceptedTypes' => 'image/*',
                    'maxFileSize' => 5120,
                    'sortablePreview' => true,
                    'useDropzone' => true
                ])
            </div>

            <!-- Code Examples -->
            <div class="mt-8 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Implementation Details</h2>

                <div class="space-y-6">
                    <!-- Before (SortableJS) -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-3">❌ Before (SortableJS)</h3>
                        <pre class="bg-gray-100 p-4 rounded-md text-sm overflow-x-auto"><code>&lt;!-- Required external CDN --&gt;
&lt;script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"&gt;&lt;/script&gt;

&lt;!-- Complex Alpine.js setup --&gt;
&lt;ul x-data="sortableUpload()" x-init="initSortable()"&gt;
    @foreach($existingMedia as $media)
        &lt;li data-id="{{ $media['id'] }}"&gt;
            @include('laravel-media::partials.upload-media-item')
        &lt;/li&gt;
    @endforeach
&lt;/ul&gt;

&lt;script&gt;
function sortableUpload() {
    return {
        sortable: null,
        initSortable() {
            // Complex SortableJS initialization
            this.sortable = Sortable.create(container, {
                handle: '.sortable-handle',
                onEnd: (evt) => {
                    // Manual order extraction and Livewire call
                    @this.call('updateMediaOrder', orderedIds);
                }
            });
        }
    }
}
&lt;/script&gt;</code></pre>
                    </div>

                    <!-- After (Livewire Sortable) -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-3">✅ After (Livewire Sortable)</h3>
                        <pre class="bg-gray-100 p-4 rounded-md text-sm overflow-x-auto"><code>&lt;!-- No external dependencies needed --&gt;

&lt;!-- Simple Livewire Sortable setup --&gt;
&lt;ul wire:sortable="updateTaskOrder"&gt;
    @foreach($existingMedia as $media)
        &lt;li wire:sortable.item="{{ $media['id'] }}" wire:key="media-{{ $media['id'] }}"&gt;
            &lt;div wire:sortable.handle class="sortable-handle"&gt;
                &lt;!-- Drag handle icon --&gt;
            &lt;/div&gt;
            @include('laravel-media::partials.upload-media-item')
        &lt;/li&gt;
    @endforeach
&lt;/ul&gt;

&lt;!-- Component method --&gt;
public function updateTaskOrder($orderedIds)
{
    foreach ($orderedIds as $index => $mediaId) {
        Media::where('id', $mediaId)
             ->update(['order_column' => $index + 1]);
    }
    $this->loadExistingMedia();
}</code></pre>
                    </div>
                </div>
            </div>

            <!-- Migration Guide -->
            <div class="mt-8 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Migration Guide</h2>

                <div class="space-y-4">
                    <div class="border-l-4 border-blue-500 pl-4">
                        <h4 class="font-medium text-gray-900">1. Install Livewire Sortable</h4>
                        <p class="text-gray-600 text-sm">Add to composer.json: <code class="bg-gray-100 px-1 rounded">"livewire-ui/sortable": "^1.0"</code></p>
                    </div>

                    <div class="border-l-4 border-blue-500 pl-4">
                        <h4 class="font-medium text-gray-900">2. Update Component</h4>
                        <p class="text-gray-600 text-sm">Add <code class="bg-gray-100 px-1 rounded">use WithSorting;</code> trait and replace <code class="bg-gray-100 px-1 rounded">updateMediaOrder()</code> with <code class="bg-gray-100 px-1 rounded">onSortOrderChange()</code></p>
                    </div>

                    <div class="border-l-4 border-blue-500 pl-4">
                        <h4 class="font-medium text-gray-900">3. Update View</h4>
                        <p class="text-gray-600 text-sm">Replace SortableJS markup with <code class="bg-gray-100 px-1 rounded">wire:sortable</code> directives</p>
                    </div>

                    <div class="border-l-4 border-blue-500 pl-4">
                        <h4 class="font-medium text-gray-900">4. Remove Scripts</h4>
                        <p class="text-gray-600 text-sm">Delete SortableJS CDN link and Alpine.js sorting functions</p>
                    </div>

                    <div class="border-l-4 border-green-500 pl-4">
                        <h4 class="font-medium text-gray-900">5. Test & Deploy</h4>
                        <p class="text-gray-600 text-sm">Everything should work the same, but faster and more reliable!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
    <!-- Livewire Sortable is included automatically when sortablePreview is enabled -->

    <script>
        // Listen for sorting events
        document.addEventListener('livewire:init', () => {
            Livewire.on('media-reordered', (event) => {
                console.log('Media reordered:', event);
                // You can add custom logic here
            });
        });
    </script>
</body>
</html>
