<?php

namespace Sorethea\Hrms\Seeders;

use Illuminate\Database\Seeder;
use Sorethea\Hrms\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::newFactory(1000)->create();
    }
}
