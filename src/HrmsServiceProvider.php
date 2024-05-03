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

    }

    public function boot(): void
    {
        $this->publishesMigrations([__DIR__.'/../database/migrations'=>database_path('migrations')],'the-a-hrms-migrations');
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
