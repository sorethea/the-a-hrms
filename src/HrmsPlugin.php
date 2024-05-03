<?php

namespace Sorethea\Hrms;
class HrmsPlugin implements \Filament\Contracts\Plugin
{

    public function getId(): string
    {
        return "the-a-hrms";
    }

    public function register(\Filament\Panel $panel): void
    {
        $panel->resources([

        ]);
    }

    public function boot(\Filament\Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
