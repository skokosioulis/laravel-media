<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Media Upload Demo - Laravel Media</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="container">
        <h1>Media Upload Demo</h1>
        
        <div class="card">
            <h2>Upload Files</h2>
            <p>Test the media upload functionality with drag & drop support.</p>
            <livewire:media-upload />
        </div>
        
        <div class="links">
            <a href="/media-demo" class="btn">← Back to Demo</a>
            <a href="/media-gallery" class="btn">View Gallery</a>
        </div>
    </div>

    @livewireScripts
</body>
</html>
