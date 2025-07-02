<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Media') }} - Demo</title>

    <!-- Tailwind CSS from CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-gray-900">Laravel Media Package</h1>
                        <span class="ml-3 px-2 py-1 text-xs font-medium bg-primary-100 text-primary-800 rounded-full">Demo</span>
                    </div>
                    <nav class="flex space-x-4">
                        <a href="/" class="text-primary-600 hover:text-primary-700 font-medium">Upload Demo</a>
                        <a href="/demo-description" class="text-gray-600 hover:text-gray-700 font-medium">Description Demo</a>
                    </nav>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

            <!-- Demo Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">File Upload Demo</h3>
                    <p class="text-sm text-gray-600 mt-1">Upload files to test the media component functionality</p>
                </div>

                <div class="p-6">
                    @php
                        $user = \Workbench\App\Models\User::first();
                        if (!$user) {
                            $user = \Workbench\App\Models\User::factory()->create([
                                'name' => 'Demo User',
                                'email' => 'demo@example.com'
                            ]);
                        }
                    @endphp

                    <!-- Livewire Media Upload Component -->
                    @livewire('media-upload', [
                        'model' => \Workbench\App\Models\User::class,
                        'modelId' => $user->id,
                        'collection' => 'avatars',
                        'multiple' => true,
                        'showPreview' => true,
                        'sortablePreview' => false
                    ])
                </div>
            </div>


        </main>

    </div>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>
