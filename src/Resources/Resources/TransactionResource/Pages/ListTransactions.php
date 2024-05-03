<?php

namespace Sorethea\Hrms\Resources\Resources\TransactionResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Sorethea\Hrms\Resources\Resources\TransactionResource;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
