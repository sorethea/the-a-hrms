<?php

namespace Sorethea\Hrms;
use Sorethea\Hrms\Resources\Resources\EmployeeResource;
use Sorethea\Hrms\Resources\Resources\HolidayResource;
use Sorethea\Hrms\Resources\Resources\LeaveResource;
use Sorethea\Hrms\Resources\Resources\OrganizationalUnitResource;
use Sorethea\Hrms\Resources\Resources\TransactionResource;

class HrmsPlugin implements \Filament\Contracts\Plugin
{

    public function getId(): string
    {
        return "the-a-hrms";
    }

    public function register(\Filament\Panel $panel): void
    {
        $panel->resources([
            EmployeeResource::class,
            HolidayResource::class,
            LeaveResource::class,
            OrganizationalUnitResource::class,
            TransactionResource::class,
        ]);
    }

    public function boot(\Filament\Panel $panel): void
    {
        // TODO: Implement boot() method.
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public static function make(): static
    {
        return app(static::class);
    }
}
