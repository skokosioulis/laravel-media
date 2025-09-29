<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Skokosioulis\LaravelMedia\Livewire\MediaGallery;
use Skokosioulis\LaravelMedia\Livewire\MediaUpload;
use Skokosioulis\LaravelMedia\Livewire\SingleMediaUpload;
use Skokosioulis\LaravelMedia\Livewire\SortableMediaGallery;
use Skokosioulis\LaravelMedia\Traits\HasMedia;

// Test model that uses HasMedia trait
class TestModelForLivewire extends Model
{
    use HasMedia;

    protected $table = 'test_models_livewire';

    protected $fillable = ['name'];
}

beforeEach(function () {
    // Create test_models table
    Schema::create('test_models_livewire', function ($table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });

    Storage::fake('public');
});

afterEach(function () {
    Schema::dropIfExists('test_models_livewire');
});

it('can render media upload component', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    Livewire::test(MediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
    ])
        ->assertStatus(200)
        ->assertSee('Click to upload')
        ->assertSee('drag and drop');
});

it('can upload files through livewire component', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    $file = UploadedFile::fake()->image('test.jpg', 100, 100);

    Livewire::test(MediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
    ])
        ->set('files', [$file])
        ->assertHasNoErrors()
        ->assertDispatched('media-uploaded');

    expect($model->fresh()->getMedia())->toHaveCount(1);
});

it('validates file uploads', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    // Create a file that's too large (assuming max is 10MB)
    $largeFile = UploadedFile::fake()->create('large.txt', 20000); // 20MB

    Livewire::test(MediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
    ])
        ->set('files', [$largeFile])
        ->assertHasErrors(['files.0']);
});

it('can remove files through livewire component', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    $file = UploadedFile::fake()->image('test.jpg', 100, 100);
    $media = $model->addMedia($file);

    Livewire::test(MediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
    ])
        ->call('removeFile', $media->id)
        ->assertDispatched('media-removed');

    expect($model->fresh()->getMedia())->toHaveCount(0);
});

it('can render media gallery component', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    $file = UploadedFile::fake()->image('test.jpg', 100, 100);
    $model->addMedia($file);

    Livewire::test(MediaGallery::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
    ])
        ->assertStatus(200)
        ->assertSee('test.jpg');
});

it('shows empty state when no media exists', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    Livewire::test(MediaGallery::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
    ])
        ->assertStatus(200)
        ->assertSee('No media files')
        ->assertSee('Upload some files to see them here');
});

it('can remove media from gallery', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    $file = UploadedFile::fake()->image('test.jpg', 100, 100);
    $media = $model->addMedia($file);

    Livewire::test(MediaGallery::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
    ])
        ->call('removeMedia', $media->id)
        ->assertDispatched('media-removed');

    expect($model->fresh()->getMedia())->toHaveCount(0);
});

it('loads existing media on component mount', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    $file1 = UploadedFile::fake()->image('test1.jpg', 100, 100);
    $file2 = UploadedFile::fake()->image('test2.jpg', 100, 100);

    $model->addMedia($file1);
    $model->addMedia($file2);

    $component = Livewire::test(MediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
    ]);

    expect($component->get('existingMedia'))->toHaveCount(2);
});

it('respects collection parameter', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    $file1 = UploadedFile::fake()->image('avatar.jpg', 100, 100);
    $file2 = UploadedFile::fake()->image('gallery.jpg', 100, 100);

    $model->addMedia($file1, 'avatars');
    $model->addMedia($file2, 'gallery');

    // Test avatars collection
    $avatarComponent = Livewire::test(MediaGallery::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'avatars',
    ]);

    expect($avatarComponent->get('media'))->toHaveCount(1);

    // Test gallery collection
    $galleryComponent = Livewire::test(MediaGallery::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'gallery',
    ]);

    expect($galleryComponent->get('media'))->toHaveCount(1);
});

it('handles multiple file uploads', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    $file1 = UploadedFile::fake()->image('test1.jpg', 100, 100);
    $file2 = UploadedFile::fake()->image('test2.jpg', 100, 100);

    Livewire::test(MediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
        'multiple' => true,
    ])
        ->set('files', [$file1, $file2])
        ->assertHasNoErrors()
        ->assertDispatched('media-uploaded');

    expect($model->fresh()->getMedia())->toHaveCount(2);
});

it('enforces single file upload when multiple is false', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    $file = UploadedFile::fake()->image('avatar.jpg', 100, 100);

    $component = Livewire::test(MediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'avatars',
        'multiple' => false,
    ]);

    expect($component->get('multiple'))->toBeFalse();
});

it('can render sortable media gallery component', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    $file1 = UploadedFile::fake()->image('test1.jpg', 100, 100);
    $file2 = UploadedFile::fake()->image('test2.jpg', 100, 100);

    $model->addMedia($file1);
    $model->addMedia($file2);

    Livewire::test(SortableMediaGallery::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
    ])
        ->assertStatus(200)
        ->assertSee('Drag and drop to reorder')
        ->assertSee('test1.jpg')
        ->assertSee('test2.jpg');
});

it('can update media order in sortable gallery', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    $file1 = UploadedFile::fake()->image('test1.jpg', 100, 100);
    $file2 = UploadedFile::fake()->image('test2.jpg', 100, 100);
    $file3 = UploadedFile::fake()->image('test3.jpg', 100, 100);

    $media1 = $model->addMedia($file1);
    $media2 = $model->addMedia($file2);
    $media3 = $model->addMedia($file3);

    // Original order should be 1, 2, 3
    expect($media1->fresh()->order_column)->toBe(1);
    expect($media2->fresh()->order_column)->toBe(2);
    expect($media3->fresh()->order_column)->toBe(3);

    // Reorder to 3, 1, 2
    $newOrder = [$media3->id, $media1->id, $media2->id];

    Livewire::test(SortableMediaGallery::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
    ])
        ->call('updateOrder', $newOrder)
        ->assertDispatched('media-reordered');

    // Check new order
    expect($media3->fresh()->order_column)->toBe(1);
    expect($media1->fresh()->order_column)->toBe(2);
    expect($media2->fresh()->order_column)->toBe(3);
});

it('can update media order in regular gallery with sortable enabled', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    $file1 = UploadedFile::fake()->image('test1.jpg', 100, 100);
    $file2 = UploadedFile::fake()->image('test2.jpg', 100, 100);

    $media1 = $model->addMedia($file1);
    $media2 = $model->addMedia($file2);

    // Test with sortable enabled
    $newOrder = [$media2->id, $media1->id];

    Livewire::test(MediaGallery::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
        'sortable' => true,
    ])
        ->call('updateMediaOrder', $newOrder)
        ->assertDispatched('media-reordered');

    // Check new order
    expect($media2->fresh()->order_column)->toBe(1);
    expect($media1->fresh()->order_column)->toBe(2);
});

it('can update media order in upload component with sortable preview', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    $file1 = UploadedFile::fake()->image('test1.jpg', 100, 100);
    $file2 = UploadedFile::fake()->image('test2.jpg', 100, 100);

    $media1 = $model->addMedia($file1);
    $media2 = $model->addMedia($file2);

    // Test reordering with Livewire Sortable format
    $newOrder = [$media2->id, $media1->id];

    Livewire::test(MediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
        'sortablePreview' => true,
    ])
        ->call('updateTaskOrder', $newOrder)
        ->assertDispatched('media-reordered');

    // Check new order
    expect($media2->fresh()->order_column)->toBe(1);
    expect($media1->fresh()->order_column)->toBe(2);
});

it('can update media description', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    // Create a media file
    $file = UploadedFile::fake()->image('test.jpg');
    $media = $model->addMedia($file, 'default');

    // Test updating description through Livewire component
    Livewire::test(MediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
    ])
        ->call('updateMediaDescription', $media->id, 'Updated description')
        ->assertHasNoErrors()
        ->assertDispatched('media-description-updated', [
            'mediaId' => $media->id,
            'description' => 'Updated description',
        ]);

    // Verify the description was updated in the database
    $media->refresh();
    expect($media->description)->toBe('Updated description');
});

it('prevents updating description of unauthorized media', function () {
    $model1 = TestModelForLivewire::create(['name' => 'Test Model 1']);
    $model2 = TestModelForLivewire::create(['name' => 'Test Model 2']);

    // Create media for model1
    $file = UploadedFile::fake()->image('test.jpg');
    $media = $model1->addMedia($file, 'default');

    // Try to update description from model2's context
    Livewire::test(MediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model2->id,
        'collection' => 'default',
    ])
        ->call('updateMediaDescription', $media->id, 'Unauthorized update')
        ->assertHasErrors(['media']);

    // Verify the description was not updated
    $media->refresh();
    expect($media->description)->toBeNull();
});

// SingleMediaUpload Component Tests
it('can render single media upload component', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    Livewire::test(SingleMediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'avatar',
    ])
        ->assertStatus(200)
        ->assertSee('Click to upload or drag and drop');
});

it('can upload single file through single media upload component', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    $file = UploadedFile::fake()->image('avatar.jpg', 100, 100);

    Livewire::test(SingleMediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'avatar',
    ])
        ->set('file', $file)
        ->assertHasNoErrors()
        ->assertDispatched('single-media-uploaded');

    expect($model->fresh()->getMedia('avatar'))->toHaveCount(1);
});

it('replaces existing media when uploading new file with replace enabled', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    // Upload first file
    $firstFile = UploadedFile::fake()->image('first.jpg', 100, 100);
    $firstMedia = $model->addMedia($firstFile, 'avatar');

    // Upload second file through component (should replace)
    $secondFile = UploadedFile::fake()->image('second.jpg', 100, 100);

    Livewire::test(SingleMediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'avatar',
        'replaceExisting' => true,
    ])
        ->set('file', $secondFile)
        ->assertHasNoErrors()
        ->assertDispatched('single-media-uploaded');

    // Should still have only 1 media item (replaced)
    expect($model->fresh()->getMedia('avatar'))->toHaveCount(1);

    // First media should be deleted
    expect($model->fresh()->getMedia('avatar')->first()->name)->toBe('second.jpg');
});

it('does not replace existing media when replace is disabled', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    // Upload first file
    $firstFile = UploadedFile::fake()->image('first.jpg', 100, 100);
    $model->addMedia($firstFile, 'avatar');

    // Upload second file through component (should not replace)
    $secondFile = UploadedFile::fake()->image('second.jpg', 100, 100);

    Livewire::test(SingleMediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'avatar',
        'replaceExisting' => false,
    ])
        ->set('file', $secondFile)
        ->assertHasNoErrors()
        ->assertDispatched('single-media-uploaded');

    // Should have 2 media items (not replaced)
    expect($model->fresh()->getMedia('avatar'))->toHaveCount(2);
});

it('can remove single media file', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    $file = UploadedFile::fake()->image('avatar.jpg', 100, 100);
    $media = $model->addMedia($file, 'avatar');

    Livewire::test(SingleMediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'avatar',
    ])
        ->call('removeFile')
        ->assertDispatched('single-media-removed');

    expect($model->fresh()->getMedia('avatar'))->toHaveCount(0);
});

it('loads existing single media on component mount', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    $file = UploadedFile::fake()->image('avatar.jpg', 100, 100);
    $media = $model->addMedia($file, 'avatar');

    $component = Livewire::test(SingleMediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'avatar',
    ]);

    expect($component->get('existingMedia'))->not->toBeNull();
    expect($component->get('existingMedia')->id)->toBe($media->id);
});

it('can update single media description', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    // Create a media file
    $file = UploadedFile::fake()->image('avatar.jpg');
    $media = $model->addMedia($file, 'avatar');

    // Test updating description through SingleMediaUpload component
    Livewire::test(SingleMediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'avatar',
    ])
        ->call('updateMediaDescription', 'Updated avatar description')
        ->assertHasNoErrors()
        ->assertDispatched('single-media-description-updated', [
            'mediaId' => $media->id,
            'description' => 'Updated avatar description',
        ]);

    // Verify the description was updated in the database
    $media->refresh();
    expect($media->description)->toBe('Updated avatar description');
});

it('validates single file uploads', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    // Create a file that's too large (assuming max is 10MB)
    $largeFile = UploadedFile::fake()->create('large.txt', 20000); // 20MB

    Livewire::test(SingleMediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'avatar',
    ])
        ->set('file', $largeFile)
        ->assertHasErrors(['file']);
});

// Dropzone vs Button Interface Tests
it('renders dropzone interface by default', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    Livewire::test(MediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
    ])
        ->assertStatus(200)
        ->assertSee('drag and drop')
        ->assertSee('border-dashed');
});

it('renders button interface when useDropzone is false', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    Livewire::test(MediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'default',
        'useDropzone' => false,
    ])
        ->assertStatus(200)
        ->assertSee('Choose Files')
        ->assertDontSee('drag and drop');
});

it('renders single media upload with dropzone by default', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    Livewire::test(SingleMediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'avatar',
    ])
        ->assertStatus(200)
        ->assertSee('drag and drop');
});

it('renders single media upload with button interface when useDropzone is false', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    Livewire::test(SingleMediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'avatar',
        'useDropzone' => false,
    ])
        ->assertStatus(200)
        ->assertSee('Choose file')
        ->assertDontSee('drag and drop');
});

it('shows replace button when existing media and useDropzone is false', function () {
    $model = TestModelForLivewire::create(['name' => 'Test Model']);

    // Upload first file
    $file = UploadedFile::fake()->image('avatar.jpg', 100, 100);
    $model->addMedia($file, 'avatar');

    Livewire::test(SingleMediaUpload::class, [
        'model' => TestModelForLivewire::class,
        'modelId' => $model->id,
        'collection' => 'avatar',
        'useDropzone' => false,
        'replaceExisting' => true,
    ])
        ->assertStatus(200)
        ->assertSee('Replace File')
        ->assertSee('Will replace existing file');
});
