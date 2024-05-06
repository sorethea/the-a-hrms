<?php

namespace Sorethea\Hrms\Resources\EmployeeResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Sorethea\Hrms\Resources\EmployeeResource;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;
}
