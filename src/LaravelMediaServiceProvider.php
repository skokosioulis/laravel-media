<?php

namespace Skokosioulis\LaravelMedia;

use Livewire\Livewire;
use Skokosioulis\LaravelMedia\Commands\LaravelMediaCommand;
use Skokosioulis\LaravelMedia\Livewire\MediaGallery;
use Skokosioulis\LaravelMedia\Livewire\MediaUpload;
use Skokosioulis\LaravelMedia\Livewire\SortableMediaGallery;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelMediaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-media')
            ->hasConfigFile('media')
            ->hasViews()
            ->hasMigration('create_media_table')
            ->hasCommand(LaravelMediaCommand::class);
    }

    public function packageBooted(): void
    {
        // Register Livewire components
        Livewire::component('media-upload', MediaUpload::class);
        Livewire::component('media-gallery', MediaGallery::class);
        Livewire::component('sortable-media-gallery', SortableMediaGallery::class);

        // Publish migrations with a specific tag
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_media_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_media_table.php'),
            ], 'laravel-media-migrations');

            // Publish views with a specific tag
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-media'),
            ], 'laravel-media-views');

            // Publish config with a specific tag
            $this->publishes([
                __DIR__.'/../config/media.php' => config_path('media.php'),
            ], 'laravel-media-config');
        }
    }
}
