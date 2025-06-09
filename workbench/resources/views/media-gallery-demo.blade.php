<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Media Gallery Demo - Laravel Media</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="container">
        <h1>Media Gallery Demo</h1>
        
        <div class="card">
            <h2>Media Gallery</h2>
            <p>Browse and manage uploaded media files.</p>
            <livewire:media-gallery />
        </div>
        
        <div class="card">
            <h2>Sortable Gallery</h2>
            <p>Drag and drop to reorder media files.</p>
            <livewire:sortable-media-gallery />
        </div>
        
        <div class="links">
            <a href="/media-demo" class="btn">← Back to Demo</a>
            <a href="/media-upload" class="btn">Upload Files</a>
        </div>
    </div>

    @livewireScripts
</body>
</html>
