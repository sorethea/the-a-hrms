<?php

namespace Sorethea\Hrms\Imports;

use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Sorethea\Hrms\Models\Employee;

class EmployeeImporter extends Importer
{
    protected static ?string $model = Employee::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('code')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('name_kh')
                ->rules(['max:255']),
            ImportColumn::make('position')
                ->rules(['max:255']),
            ImportColumn::make('avatar_url')
                ->rules(['max:255']),
            ImportColumn::make('date_of_birth')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('hired_date')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('type')
                ->rules(['max:255']),
            ImportColumn::make('level')
                ->rules(['max:255']),
            ImportColumn::make('sift')
                ->rules(['max:255']),
            ImportColumn::make('probation_duration')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('leave_balance')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('probation_confirmation_date')
                ->rules(['date']),
            ImportColumn::make('last_working_date')
                ->rules(['date']),
            ImportColumn::make('gender')
                ->rules(['max:255']),
            ImportColumn::make('marital_status')
                ->rules(['max:255']),
            ImportColumn::make('email')
                ->rules(['email', 'max:255']),
            ImportColumn::make('phone_number')
                ->rules(['max:255']),
            ImportColumn::make('bank_name')
                ->rules(['max:255']),
            ImportColumn::make('bank_account')
                ->rules(['max:255']),
            ImportColumn::make('remark')
                ->rules(['max:255']),
            ImportColumn::make('user_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('report_to')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('ou')
                ->relationship(),
            ImportColumn::make('category_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('properties'),
            ImportColumn::make('active')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
        ];
    }

    public function resolveRecord(): ?Employee
    {
        // return Employee::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Employee();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your employee import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
