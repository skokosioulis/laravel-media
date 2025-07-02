<?php

namespace Workbench\App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->ensureCacheDirectoriesExist();
    }

    /**
     * Ensure all required cache directories exist.
     */
    protected function ensureCacheDirectoriesExist(): void
    {
        $directories = [
            // Workbench storage directories
            storage_path('framework/cache'),
            storage_path('framework/cache/data'),
            storage_path('framework/sessions'),
            storage_path('framework/testing'),
            storage_path('framework/views'),
            storage_path('logs'),
            storage_path('app'),
            storage_path('app/public'),

            // Bootstrap cache
            base_path('bootstrap/cache'),

            // Testbench core directories
            base_path('vendor/orchestra/testbench-core/laravel/storage/framework/cache'),
            base_path('vendor/orchestra/testbench-core/laravel/storage/framework/cache/data'),
            base_path('vendor/orchestra/testbench-core/laravel/storage/framework/sessions'),
            base_path('vendor/orchestra/testbench-core/laravel/storage/framework/testing'),
            base_path('vendor/orchestra/testbench-core/laravel/storage/framework/views'),
            base_path('vendor/orchestra/testbench-core/laravel/storage/logs'),
            base_path('vendor/orchestra/testbench-core/laravel/bootstrap/cache'),
        ];

        foreach ($directories as $directory) {
            if (! File::exists($directory)) {
                try {
                    File::makeDirectory($directory, 0755, true);
                } catch (\Exception $e) {
                    // Silently continue if directory creation fails
                    // This prevents the application from crashing
                }
            }
        }
    }
}
