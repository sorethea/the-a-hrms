<?php

namespace Sorethea\Hrms\Resources\Resources\LeaveResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Sorethea\Hrms\Resources\Resources\LeaveResource;

class EditLeave extends EditRecord
{
    protected static string $resource = LeaveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
