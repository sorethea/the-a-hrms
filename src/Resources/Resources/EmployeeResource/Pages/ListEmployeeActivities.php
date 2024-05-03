<?php

namespace Sorethea\Hrms\Resources\Resources\EmployeeResource\Pages;

use App\Helpers\LeaveHelper;
use Filament\Actions;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;
use Sorethea\Hrms\Models\Employee;
use Sorethea\Hrms\Resources\Exports\EmployeeExporter;
use Sorethea\Hrms\Resources\Resources\EmployeeResource;

class ListEmployeeActivities extends ListActivities
{
    protected static string $resource = EmployeeResource::class;
}
