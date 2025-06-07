<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Media Package Example</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Laravel Media Package Example</h1>
        
        <!-- Upload Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Upload Files</h2>
            
            <!-- Example: Upload to a specific model and collection -->
            @livewire('media-upload', [
                'model' => 'App\\Models\\User',
                'modelId' => 1,
                'collection' => 'avatars',
                'multiple' => false,
                'acceptedTypes' => 'image/jpeg,image/png,image/webp',
                'maxFileSize' => 5120,
                'showPreview' => true
            ])
        </div>
        
        <!-- Gallery Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Media Gallery</h2>

            <!-- Example: Display media gallery -->
            @livewire('media-gallery', [
                'model' => 'App\\Models\\User',
                'modelId' => 1,
                'collection' => 'avatars',
                'columns' => 4,
                'showInfo' => true,
                'sortable' => false
            ])
        </div>

        <!-- Sortable Gallery Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Sortable Media Gallery</h2>

            <!-- Example: Sortable media gallery -->
            @livewire('sortable-media-gallery', [
                'model' => 'App\\Models\\User',
                'modelId' => 1,
                'collection' => 'gallery',
                'columns' => 4,
                'showInfo' => true
            ])
        </div>
        
        <!-- Multiple Collections Example -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Documents Collection -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Documents</h3>
                @livewire('media-upload', [
                    'model' => 'App\\Models\\User',
                    'modelId' => 1,
                    'collection' => 'documents',
                    'multiple' => true,
                    'acceptedTypes' => 'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'showPreview' => true
                ])
            </div>
            
            <!-- Gallery Collection with Sortable Preview -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Photo Gallery (Sortable)</h3>
                @livewire('media-upload', [
                    'model' => 'App\\Models\\User',
                    'modelId' => 1,
                    'collection' => 'gallery',
                    'multiple' => true,
                    'acceptedTypes' => 'image/jpeg,image/png,image/gif,image/webp',
                    'showPreview' => true,
                    'sortablePreview' => true
                ])
            </div>
        </div>
        
        <!-- Usage Examples -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Usage Examples</h2>
            
            <div class="space-y-4">
                <div>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">1. Add HasMedia trait to your model:</h3>
                    <pre class="bg-gray-100 p-4 rounded-md text-sm overflow-x-auto"><code>use Skokosioulis\LaravelMedia\Traits\HasMedia;

class User extends Model
{
    use HasMedia;
    
    // Your model code...
}</code></pre>
                </div>
                
                <div>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">2. Upload files programmatically:</h3>
                    <pre class="bg-gray-100 p-4 rounded-md text-sm overflow-x-auto"><code>$user = User::find(1);

// Upload a file
$media = $user->addMedia($uploadedFile, 'avatars');

// Upload from path
$media = $user->addMediaFromPath('/path/to/file.jpg', 'gallery');

// Get media
$avatars = $user->getMedia('avatars');
$firstAvatar = $user->getFirstMedia('avatars');
$avatarUrl = $user->getFirstMediaUrl('avatars', '/default-avatar.jpg');</code></pre>
                </div>
                
                <div>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">3. Use Livewire components in Blade:</h3>
                    <pre class="bg-gray-100 p-4 rounded-md text-sm overflow-x-auto"><code>{{-- Upload Component --}}
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
    'columns' => 6
])</code></pre>
                </div>
                
                <div>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">4. Query media:</h3>
                    <pre class="bg-gray-100 p-4 rounded-md text-sm overflow-x-auto"><code>// Get all images
$images = $user->media()->images()->get();

// Get documents
$documents = $user->media()->documents()->get();

// Get media by type
$videos = $user->media()->ofType('video')->get();

// Get media in specific collection
$galleryItems = $user->media()->inCollection('gallery')->get();</code></pre>
                </div>
            </div>
        </div>
    </div>
    
    @livewireScripts
</body>
</html>
