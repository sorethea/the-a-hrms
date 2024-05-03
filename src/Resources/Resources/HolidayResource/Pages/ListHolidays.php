<?php

namespace Sorethea\Hrms\Resources\Resources\HolidayResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Sorethea\Hrms\Resources\Resources\HolidayResource;

class ListHolidays extends ListRecords
{
    protected static string $resource = HolidayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
