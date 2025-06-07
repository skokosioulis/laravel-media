<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Skokosioulis\LaravelMedia\Models\Media;
use Skokosioulis\LaravelMedia\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;

// Test model that uses HasMedia trait
class TestModel extends Model
{
    use HasMedia;
    
    protected $table = 'test_models';
    protected $fillable = ['name'];
}

beforeEach(function () {
    // Create test_models table
    Schema::create('test_models', function ($table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });
    
    Storage::fake('public');
});

afterEach(function () {
    Schema::dropIfExists('test_models');
});

it('can create a media record', function () {
    $media = Media::create([
        'name' => 'test-image.jpg',
        'file_name' => 'test-image-123.jpg',
        'mime_type' => 'image/jpeg',
        'disk' => 'public',
        'path' => 'media/test-image-123.jpg',
        'size' => 1024,
        'type' => 'image',
        'collection_name' => 'default',
        'order_column' => 1,
    ]);

    expect($media)->toBeInstanceOf(Media::class);
    expect($media->name)->toBe('test-image.jpg');
    expect($media->type)->toBe('image');
});

it('can determine file type from mime type', function () {
    $media = new Media();
    
    expect($media->getTypeFromMimeType())->toBe('file');
    
    $media->mime_type = 'image/jpeg';
    expect($media->getTypeFromMimeType())->toBe('image');
    
    $media->mime_type = 'video/mp4';
    expect($media->getTypeFromMimeType())->toBe('video');
    
    $media->mime_type = 'audio/mpeg';
    expect($media->getTypeFromMimeType())->toBe('audio');
    
    $media->mime_type = 'application/pdf';
    expect($media->getTypeFromMimeType())->toBe('document');
});

it('can check if media is image', function () {
    $media = Media::create([
        'name' => 'test-image.jpg',
        'file_name' => 'test-image-123.jpg',
        'mime_type' => 'image/jpeg',
        'disk' => 'public',
        'path' => 'media/test-image-123.jpg',
        'size' => 1024,
        'type' => 'image',
        'collection_name' => 'default',
        'order_column' => 1,
    ]);

    expect($media->isImage())->toBeTrue();
    expect($media->isVideo())->toBeFalse();
    expect($media->isAudio())->toBeFalse();
    expect($media->isPdf())->toBeFalse();
});

it('can get human readable size', function () {
    $media = Media::create([
        'name' => 'test-file.txt',
        'file_name' => 'test-file-123.txt',
        'mime_type' => 'text/plain',
        'disk' => 'public',
        'path' => 'media/test-file-123.txt',
        'size' => 1024,
        'type' => 'file',
        'collection_name' => 'default',
        'order_column' => 1,
    ]);

    expect($media->human_readable_size)->toBe('1 KB');
});

it('can add media to a model using HasMedia trait', function () {
    $model = TestModel::create(['name' => 'Test Model']);
    
    $file = UploadedFile::fake()->image('test.jpg', 100, 100);
    
    $media = $model->addMedia($file);
    
    expect($media)->toBeInstanceOf(Media::class);
    expect($media->mediable_type)->toBe(TestModel::class);
    expect($media->mediable_id)->toBe($model->id);
    expect($media->type)->toBe('image');
    expect($media->collection_name)->toBe('default');
});

it('can add media to a specific collection', function () {
    $model = TestModel::create(['name' => 'Test Model']);
    
    $file = UploadedFile::fake()->image('avatar.jpg', 100, 100);
    
    $media = $model->addMedia($file, 'avatars');
    
    expect($media->collection_name)->toBe('avatars');
});

it('can get media from a model', function () {
    $model = TestModel::create(['name' => 'Test Model']);
    
    $file1 = UploadedFile::fake()->image('test1.jpg', 100, 100);
    $file2 = UploadedFile::fake()->image('test2.jpg', 100, 100);
    
    $model->addMedia($file1);
    $model->addMedia($file2);
    
    $media = $model->getMedia();
    
    expect($media)->toHaveCount(2);
    expect($media->first())->toBeInstanceOf(Media::class);
});

it('can get first media from a collection', function () {
    $model = TestModel::create(['name' => 'Test Model']);
    
    $file1 = UploadedFile::fake()->image('test1.jpg', 100, 100);
    $file2 = UploadedFile::fake()->image('test2.jpg', 100, 100);
    
    $model->addMedia($file1, 'gallery');
    $model->addMedia($file2, 'gallery');
    
    $firstMedia = $model->getFirstMedia('gallery');
    
    expect($firstMedia)->toBeInstanceOf(Media::class);
    expect($firstMedia->collection_name)->toBe('gallery');
});

it('can get first media url', function () {
    $model = TestModel::create(['name' => 'Test Model']);
    
    $file = UploadedFile::fake()->image('test.jpg', 100, 100);
    $media = $model->addMedia($file);
    
    $url = $model->getFirstMediaUrl();
    
    expect($url)->toContain('storage/media/');
    expect($url)->toContain('.jpg');
});

it('returns default url when no media exists', function () {
    $model = TestModel::create(['name' => 'Test Model']);
    
    $url = $model->getFirstMediaUrl('default', '/default-image.jpg');
    
    expect($url)->toBe('/default-image.jpg');
});

it('can check if model has media', function () {
    $model = TestModel::create(['name' => 'Test Model']);
    
    expect($model->hasMedia())->toBeFalse();
    
    $file = UploadedFile::fake()->image('test.jpg', 100, 100);
    $model->addMedia($file);
    
    expect($model->hasMedia())->toBeTrue();
});

it('can clear media collection', function () {
    $model = TestModel::create(['name' => 'Test Model']);
    
    $file1 = UploadedFile::fake()->image('test1.jpg', 100, 100);
    $file2 = UploadedFile::fake()->image('test2.jpg', 100, 100);
    
    $model->addMedia($file1);
    $model->addMedia($file2);
    
    expect($model->getMedia())->toHaveCount(2);
    
    $model->clearMediaCollection();
    
    expect($model->getMedia())->toHaveCount(0);
});

it('can add media from path', function () {
    $model = TestModel::create(['name' => 'Test Model']);
    
    // Create a temporary file
    $tempFile = tempnam(sys_get_temp_dir(), 'test');
    file_put_contents($tempFile, 'test content');
    
    $media = $model->addMediaFromPath($tempFile);
    
    expect($media)->toBeInstanceOf(Media::class);
    expect($media->mediable_type)->toBe(TestModel::class);
    expect($media->mediable_id)->toBe($model->id);
    
    // Clean up
    unlink($tempFile);
});

it('can scope media by type', function () {
    $model = TestModel::create(['name' => 'Test Model']);
    
    $imageFile = UploadedFile::fake()->image('test.jpg', 100, 100);
    $textFile = UploadedFile::fake()->create('test.txt', 100, 'text/plain');
    
    $model->addMedia($imageFile);
    $model->addMedia($textFile);
    
    $images = $model->media()->images()->get();
    $files = $model->media()->ofType('file')->get();
    
    expect($images)->toHaveCount(1);
    expect($files)->toHaveCount(1);
});

it('deletes physical file when media is deleted', function () {
    $model = TestModel::create(['name' => 'Test Model']);
    
    $file = UploadedFile::fake()->image('test.jpg', 100, 100);
    $media = $model->addMedia($file);
    
    // Check file exists
    Storage::disk('public')->assertExists($media->path);
    
    // Delete media
    $media->delete();
    
    // Check file is deleted
    Storage::disk('public')->assertMissing($media->path);
});
