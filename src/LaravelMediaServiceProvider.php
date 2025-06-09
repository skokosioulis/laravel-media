<?php

namespace Skokosioulis\LaravelMedia;

use Livewire\Livewire;
use Skokosioulis\LaravelMedia\Commands\LaravelMediaCommand;
use Skokosioulis\LaravelMedia\Commands\LaravelMediaInstallCommand;
use Skokosioulis\LaravelMedia\Livewire\MediaGallery;
use Skokosioulis\LaravelMedia\Livewire\MediaUpload;
use Skokosioulis\LaravelMedia\Livewire\SortableMediaGallery;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasTranslations()
            ->hasAssets()
            ->hasRoute('web')
            ->hasMigration('create_media_table')
            ->hasCommands([
                LaravelMediaCommand::class,
                LaravelMediaInstallCommand::class,
            ])
            ->publishesServiceProvider('LaravelMediaServiceProvider');
    }

    public function packageRegistered(): void
    {
        // Register any package services here
    }

    public function packageBooted(): void
    {
        // Register Livewire components
        if (class_exists(Livewire::class)) {
            Livewire::component('media-upload', MediaUpload::class);
            Livewire::component('media-gallery', MediaGallery::class);
            Livewire::component('sortable-media-gallery', SortableMediaGallery::class);
        }

        // Register additional view namespace for laravel-media
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-media');
    }
}
