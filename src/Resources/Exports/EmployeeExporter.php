<?php

namespace Sorethea\Hrms\Resources\Exports;

use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Sorethea\Hrms\Models\Employee;

class EmployeeExporter extends Exporter
{
    protected static ?string $model = Employee::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('code'),
            ExportColumn::make('name'),
            ExportColumn::make('name_kh'),
            ExportColumn::make('position'),
            ExportColumn::make('avatar_url'),
            ExportColumn::make('date_of_birth'),
            ExportColumn::make('hired_date'),
            ExportColumn::make('type'),
            ExportColumn::make('level'),
            ExportColumn::make('sift'),
            ExportColumn::make('probation_duration'),
            ExportColumn::make('leave_balance'),
            ExportColumn::make('probation_confirmation_date'),
            ExportColumn::make('last_working_date'),
            ExportColumn::make('gender'),
            ExportColumn::make('marital_status'),
            ExportColumn::make('email'),
            ExportColumn::make('phone_number'),
            ExportColumn::make('bank_name'),
            ExportColumn::make('bank_account'),
            ExportColumn::make('remark'),
            ExportColumn::make('user_id'),
            ExportColumn::make('report_to'),
            ExportColumn::make('ou.name'),
            ExportColumn::make('category_id'),
            ExportColumn::make('properties'),
            ExportColumn::make('active'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your employee export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
