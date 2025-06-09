<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Media Demo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="container">
        <h1>Laravel Media Package Demo</h1>
        
        <div class="card">
            <h2>Media Upload Component</h2>
            <livewire:media-upload />
        </div>
        
        <div class="card">
            <h2>Media Gallery Component</h2>
            <livewire:media-gallery />
        </div>
        
        <div class="card">
            <h2>Sortable Media Gallery Component</h2>
            <livewire:sortable-media-gallery />
        </div>
        
        <div class="links">
            <a href="/" class="btn">← Back to Home</a>
            <a href="/media-upload" class="btn">Upload Demo</a>
            <a href="/media-gallery" class="btn">Gallery Demo</a>
        </div>
    </div>

    @livewireScripts
</body>
</html>
