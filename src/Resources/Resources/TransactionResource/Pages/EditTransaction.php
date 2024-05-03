<?php

namespace Sorethea\Hrms\Resources\Resources\TransactionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Sorethea\Hrms\Resources\Resources\TransactionResource;

class EditTransaction extends EditRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
