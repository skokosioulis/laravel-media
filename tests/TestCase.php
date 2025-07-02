<?php

namespace Skokosioulis\LaravelMedia\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Skokosioulis\LaravelMedia\LaravelMediaServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Skokosioulis\\LaravelMedia\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelMediaServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        config()->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        // Set up storage paths for testing
        $tempDir = $this->getTempDirectory();

        // Create necessary directories
        $directories = [
            $tempDir.'/views',
            $tempDir.'/cache',
            $tempDir.'/framework',
            $tempDir.'/framework/cache',
            $tempDir.'/framework/sessions',
            $tempDir.'/framework/testing',
            $tempDir.'/framework/views',
            $tempDir.'/app',
            $tempDir.'/logs',
        ];

        foreach ($directories as $dir) {
            if (! is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
        }

        // Set up configuration
        config()->set('view.compiled', $tempDir.'/views');
        config()->set('cache.stores.file.path', $tempDir.'/cache');
        config()->set('app.key', 'base64:z6IHu63UVM3FPNFj/QPBWbEjVHiu/hda9lDw7ua4bhs=');
        config()->set('app.cipher', 'AES-256-CBC');

        // Override storage path
        $app->useStoragePath($tempDir);
    }

    protected function getTempDirectory(): string
    {
        return __DIR__.'/temp';
    }

    protected function defineDatabaseMigrations()
    {
        // Run the media table migration
        $migration = include __DIR__.'/../database/migrations/create_media_table.php.stub';
        $migration->up();
    }
}
