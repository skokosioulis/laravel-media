<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Skokosioulis\LaravelMedia\Livewire\MediaUpload;
use Skokosioulis\LaravelMedia\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;

// Test model that uses HasMedia trait
class TestModelForMimeValidation extends Model
{
    use HasMedia;
    
    protected $table = 'test_models_mime';
    protected $fillable = ['name'];
}

beforeEach(function () {
    // Create test_models table
    Schema::create('test_models_mime', function ($table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });
    
    Storage::fake('public');
});

afterEach(function () {
    Schema::dropIfExists('test_models_mime');
});

it('validates allowed MIME types correctly', function () {
    $model = TestModelForMimeValidation::create(['name' => 'Test Model']);
    
    // Create a valid image file
    $validFile = UploadedFile::fake()->image('test.jpg', 100, 100);
    
    // Test with default configuration (should allow images)
    Livewire::test(MediaUpload::class, [
        'model' => TestModelForMimeValidation::class,
        'modelId' => $model->id,
        'collection' => 'default'
    ])
    ->set('files', [$validFile])
    ->assertHasNoErrors();
});

it('rejects disallowed MIME types', function () {
    $model = TestModelForMimeValidation::create(['name' => 'Test Model']);
    
    // Create a file with disallowed MIME type
    $invalidFile = UploadedFile::fake()->create('test.xyz', 100, 'application/x-unknown');
    
    Livewire::test(MediaUpload::class, [
        'model' => TestModelForMimeValidation::class,
        'modelId' => $model->id,
        'collection' => 'default'
    ])
    ->set('files', [$invalidFile])
    ->assertHasErrors(['files.0']);
});

it('respects collection-specific MIME type restrictions', function () {
    // Temporarily override config for this test
    config(['media.collections.avatars.accepts_mime_types' => ['image/jpeg', 'image/png']]);
    
    $model = TestModelForMimeValidation::create(['name' => 'Test Model']);
    
    // Create a GIF file (not allowed in avatars collection)
    $gifFile = UploadedFile::fake()->create('test.gif', 100, 'image/gif');
    
    Livewire::test(MediaUpload::class, [
        'model' => TestModelForMimeValidation::class,
        'modelId' => $model->id,
        'collection' => 'avatars'
    ])
    ->set('files', [$gifFile])
    ->assertHasErrors(['files.0']);
});

it('allows collection-specific MIME types', function () {
    // Temporarily override config for this test
    config(['media.collections.avatars.accepts_mime_types' => ['image/jpeg', 'image/png']]);
    
    $model = TestModelForMimeValidation::create(['name' => 'Test Model']);
    
    // Create a JPEG file (allowed in avatars collection)
    $jpegFile = UploadedFile::fake()->image('test.jpg', 100, 100);
    
    Livewire::test(MediaUpload::class, [
        'model' => TestModelForMimeValidation::class,
        'modelId' => $model->id,
        'collection' => 'avatars'
    ])
    ->set('files', [$jpegFile])
    ->assertHasNoErrors();
});

it('validates file size limits', function () {
    $model = TestModelForMimeValidation::create(['name' => 'Test Model']);
    
    // Create a file that's too large (assuming max is 10MB = 10240KB)
    $largeFile = UploadedFile::fake()->create('large.txt', 20000); // 20MB
    
    Livewire::test(MediaUpload::class, [
        'model' => TestModelForMimeValidation::class,
        'modelId' => $model->id,
        'collection' => 'default',
        'maxFileSize' => 10240 // 10MB
    ])
    ->set('files', [$largeFile])
    ->assertHasErrors(['files.0']);
});

it('provides helpful error messages for invalid MIME types', function () {
    $model = TestModelForMimeValidation::create(['name' => 'Test Model']);
    
    // Create a file with disallowed MIME type
    $invalidFile = UploadedFile::fake()->create('test.xyz', 100, 'application/x-unknown');
    
    $component = Livewire::test(MediaUpload::class, [
        'model' => TestModelForMimeValidation::class,
        'modelId' => $model->id,
        'collection' => 'default'
    ])
    ->set('files', [$invalidFile]);
    
    $errors = $component->errors();
    expect($errors)->toHaveKey('files.0');
    expect($errors['files.0'][0])->toContain('file type');
    expect($errors['files.0'][0])->toContain('not allowed');
});

it('generates correct accept attribute for HTML input', function () {
    $model = TestModelForMimeValidation::create(['name' => 'Test Model']);
    
    $component = Livewire::test(MediaUpload::class, [
        'model' => TestModelForMimeValidation::class,
        'modelId' => $model->id,
        'collection' => 'default'
    ]);
    
    $acceptedTypes = $component->get('acceptedTypes');
    
    // Should contain both MIME types and file extensions
    expect($acceptedTypes)->toContain('image/jpeg');
    expect($acceptedTypes)->toContain('.jpg');
    expect($acceptedTypes)->toContain('application/pdf');
    expect($acceptedTypes)->toContain('.pdf');
});
