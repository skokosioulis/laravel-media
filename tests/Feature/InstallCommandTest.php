<?php

namespace Skokosioulis\LaravelMedia\Tests\Feature;

use Illuminate\Support\Facades\File;
use Skokosioulis\LaravelMedia\Tests\TestCase;

class InstallCommandTest extends TestCase
{
    /** @test */
    public function it_can_install_the_package()
    {
        $this->artisan('laravel-media:install')
            ->expectsConfirmation('Do you want to publish the views for customization?', 'no')
            ->expectsConfirmation('Do you want to publish the assets?', 'no')
            ->expectsConfirmation('Do you want to publish the translations for customization?', 'no')
            ->expectsConfirmation('Do you want to run the migrations now?', 'no')
            ->expectsOutput('Installing Laravel Media package...')
            ->expectsOutput('✓ Published configuration file')
            ->expectsOutput('✓ Published migration files')
            ->expectsOutput('Laravel Media package installed successfully!')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_can_install_with_all_options()
    {
        $this->artisan('laravel-media:install')
            ->expectsConfirmation('Do you want to publish the views for customization?', 'yes')
            ->expectsConfirmation('Do you want to publish the assets?', 'yes')
            ->expectsConfirmation('Do you want to publish the translations for customization?', 'yes')
            ->expectsConfirmation('Do you want to run the migrations now?', 'no')
            ->expectsOutput('Installing Laravel Media package...')
            ->expectsOutput('✓ Published configuration file')
            ->expectsOutput('✓ Published migration files')
            ->expectsOutput('✓ Published view files')
            ->expectsOutput('✓ Published asset files')
            ->expectsOutput('✓ Published translation files')
            ->expectsOutput('Laravel Media package installed successfully!')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_can_force_install()
    {
        $this->artisan('laravel-media:install --force')
            ->expectsConfirmation('Do you want to publish the views for customization?', 'no')
            ->expectsConfirmation('Do you want to publish the assets?', 'no')
            ->expectsConfirmation('Do you want to publish the translations for customization?', 'no')
            ->expectsConfirmation('Do you want to run the migrations now?', 'no')
            ->assertExitCode(0);
    }
}
