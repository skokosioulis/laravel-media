<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel Media Workbench</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .container {
                text-align: center;
                max-width: 600px;
                padding: 2rem;
            }
            .title {
                font-size: 3rem;
                margin-bottom: 1rem;
                font-weight: 300;
            }
            .subtitle {
                font-size: 1.2rem;
                margin-bottom: 2rem;
                opacity: 0.9;
            }
            .links {
                margin-top: 2rem;
            }
            .links a {
                color: white;
                text-decoration: none;
                margin: 0 1rem;
                padding: 0.5rem 1rem;
                border: 1px solid rgba(255,255,255,0.3);
                border-radius: 4px;
                transition: all 0.3s ease;
            }
            .links a:hover {
                background: rgba(255,255,255,0.1);
                border-color: rgba(255,255,255,0.6);
            }
            .version {
                margin-top: 2rem;
                opacity: 0.7;
                font-size: 0.9rem;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="title">
                Laravel Media Workbench
            </div>
            <div class="subtitle">
                Development environment for Laravel Media package
            </div>
            <div class="links">
                <a href="/media-demo">Package Demo</a>
                <a href="/media-upload">Upload Demo</a>
                <a href="/media-gallery">Gallery Demo</a>
                <a href="https://laravel.com/docs" target="_blank">Laravel Docs</a>
                <a href="https://github.com/skokosioulis/laravel-media" target="_blank">GitHub</a>
            </div>
            <div class="version">
                Laravel {{ app()->version() }} | PHP {{ PHP_VERSION }}
            </div>
        </div>
    </body>
</html>
