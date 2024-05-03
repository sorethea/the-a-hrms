<?php

namespace Sorethea\Hrms\Resources\Resources\EmployeeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Sorethea\Hrms\Resources\Resources\EmployeeResource;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
