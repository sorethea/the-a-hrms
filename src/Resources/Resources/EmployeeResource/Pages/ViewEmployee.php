<?php

namespace Sorethea\Hrms\Resources\Resources\EmployeeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Sorethea\Hrms\Resources\Resources\EmployeeResource;

class ViewEmployee extends ViewRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
