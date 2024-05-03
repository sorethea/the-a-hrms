<?php

namespace Sorethea\Hrms;

use Illuminate\Support\ServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class HrmsServiceProvider extends PackageServiceProvider
{

    public static string $name = "the-a-hrms";
    public function register(): void
    {
        if (! app()->configurationIsCached()) {
            $this->mergeConfigFrom(__DIR__.'/../config/hrms.php', 'hrms');
        }
    }

    public function boot(): void
    {
        $this->publishesMigrations([__DIR__.'/../database/migrations'=>database_path('migrations')],'the-a-hrms-migrations');
        $this->publishes([
            __DIR__.'/../config/hrms.php' => config_path('hrms.php'),
        ], 'hrms-config');
    }

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations()
            ->hasTranslations()
            ->hasViews();
    }
}
