<?php

namespace Sorethea\Hrms\Resources\LeaveResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Sorethea\Hrms\Helpers\LeaveHelper;
use Sorethea\Hrms\Resources\LeaveResource;

class ViewLeave extends ViewRecord
{
    protected static string $resource = LeaveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make("approve")
                ->icon("heroicon-o-check")
                ->color("success")
                ->requiresConfirmation()
                ->action(fn($record)=>LeaveHelper::approve($record))
                ->visible(fn($record)=>$record->status=="pending"),
            Actions\Action::make("cancel")
                ->icon("heroicon-o-pause")
                ->color("warning")
                ->requiresConfirmation()
                ->action(fn($record)=>LeaveHelper::cancel($record))
                ->visible(fn($record)=>$record->status=="pending"),
            Actions\Action::make("reject")
                ->icon("heroicon-o-no-symbol")
                ->color("danger")
                ->requiresConfirmation()
                ->action(fn($record)=>LeaveHelper::reject($record))
                ->visible(fn($record)=>$record->status=="approved"),
        ];
    }
    public function getRelationManagers(): array
    {
        return [
            LeaveResource\RelationManagers\TransactionsRelationManager::class,
        ];
    }
}
