<?php

namespace Yuges\Contentable\Tests;

use Illuminate\Contracts\Config\Repository;
use Orchestra\Testbench\Attributes\WithMigration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\LaravelData\LaravelDataServiceProvider;
use Yuges\Contentable\Providers\ContentableServiceProvider;

#[WithMigration]
class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        # code...

        parent::setUp();
    }

    protected function defineEnvironment($app)
    {
        tap($app['config'], function (Repository $config) {
            $config->set('contentable', require __DIR__ . '/../../config/contentable.php');
            $config->set('data', require __DIR__ . '/../../vendor/spatie/laravel-data/config/data.php');
        });
    }

    protected function getPackageProviders($app)
    {
        return [
            ContentableServiceProvider::class,
            LaravelDataServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom([
                __DIR__ . '/../../database/migrations/',
                __DIR__ . '/Stubs/Migrations',
            ]
        );
    }
}
