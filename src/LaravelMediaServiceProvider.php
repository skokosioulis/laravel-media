<?php

namespace Skokosioulis\LaravelMedia;

use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Skokosioulis\LaravelMedia\Commands\LaravelMediaCommand;
use Skokosioulis\LaravelMedia\Livewire\MediaUpload;
use Skokosioulis\LaravelMedia\Livewire\MediaGallery;
use Skokosioulis\LaravelMedia\Livewire\SortableMediaGallery;

class LaravelMediaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
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
    }
}
