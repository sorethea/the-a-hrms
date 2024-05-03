<?php

namespace Sorethea\Hrms\Resources\Resources\OrganizationalUnitResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Sorethea\Hrms\Resources\Resources\OrganizationalUnitResource;

class EditOrganizationalUnit extends EditRecord
{
    protected static string $resource = OrganizationalUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
