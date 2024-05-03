<?php

namespace Sorethea\Hrms\Resources\Resources\OrganizationalUnitResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Sorethea\Hrms\Resources\Resources\OrganizationalUnitResource;

class ListOrganizationalUnits extends ListRecords
{
    protected static string $resource = OrganizationalUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
