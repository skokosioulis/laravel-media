<?php

namespace Skokosioulis\LaravelMedia\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LaravelMediaInstallCommand extends Command
{
    public $signature = 'laravel-media:install {--force : Overwrite existing files}';

    public $description = 'Install Laravel Media package';

    public function handle(): int
    {
        $this->info('Installing Laravel Media package...');

        // Publish configuration
        $this->publishConfig();

        // Publish migrations
        $this->publishMigrations();

        // Publish views (optional)
        if ($this->confirm('Do you want to publish the views for customization?', false)) {
            $this->publishViews();
        }

        // Publish assets (optional)
        if ($this->confirm('Do you want to publish the assets?', false)) {
            $this->publishAssets();
        }

        // Publish translations (optional)
        if ($this->confirm('Do you want to publish the translations for customization?', false)) {
            $this->publishTranslations();
        }

        // Run migrations
        if ($this->confirm('Do you want to run the migrations now?', true)) {
            $this->runMigrations();
        }

        $this->info('Laravel Media package installed successfully!');
        $this->newLine();
        $this->info('Next steps:');
        $this->line('1. Configure your media settings in config/media.php');
        $this->line('2. Add the HasMedia trait to your models');
        $this->line('3. Use the Livewire components in your views');
        $this->newLine();
        $this->info('Documentation: https://github.com/skokosioulis/laravel-media');

        return self::SUCCESS;
    }

    protected function publishConfig(): void
    {
        $configPath = config_path('media.php');

        if (File::exists($configPath) && ! $this->option('force')) {
            if (! $this->confirm('Config file already exists. Do you want to overwrite it?', false)) {
                $this->line('Skipping config file...');

                return;
            }
        }

        $this->call('vendor:publish', [
            '--tag' => 'laravel-media-config',
            '--force' => $this->option('force'),
        ]);

        $this->info('✓ Published configuration file');
    }

    protected function publishMigrations(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'laravel-media-migrations',
            '--force' => $this->option('force'),
        ]);

        $this->info('✓ Published migration files');
    }

    protected function publishViews(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'laravel-media-views',
            '--force' => $this->option('force'),
        ]);

        $this->info('✓ Published view files');
    }

    protected function publishAssets(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'laravel-media-assets',
            '--force' => $this->option('force'),
        ]);

        $this->info('✓ Published asset files');
    }

    protected function publishTranslations(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'laravel-media-translations',
            '--force' => $this->option('force'),
        ]);

        $this->info('✓ Published translation files');
    }

    protected function runMigrations(): void
    {
        $this->call('migrate');
        $this->info('✓ Migrations completed');
    }
}
