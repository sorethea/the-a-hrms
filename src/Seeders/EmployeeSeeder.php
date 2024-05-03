<?php

namespace Sorethea\Hrms\Seeders;

use Illuminate\Database\Seeder;
use Sorethea\Hrms\Helpers\LeaveHelper;
use Sorethea\Hrms\Models\Employee;
use Sorethea\Hrms\Models\Leave;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Employee::factory(1000)->create()->each(function($employee){
            if($employee->active && str_contains($employee->position,"Manager")){
                Employee::factory(random_int(3,10))->create(["report_to"=>$employee->id]);
            }
        });

        $this->call([
            Holiday2024::class
        ]);

        Leave::factory(1000)->create()->each(function (Leave $leave){
            $balance = $leave->employee->leave_balance ?? 0;
            if($balance >= $leave->qty){

                $i = fake()->randomElement([1,2,3,4,5,6]);
                if(in_array($i,[1,2,3,4,5])){
                    LeaveHelper::approve($leave);
                    $j = fake()->randomElement([1,2,3,4,5,6]);
                    if($j == 6)
                    LeaveHelper::reject($leave);
                }
            }else{
                LeaveHelper::cancel($leave);
            }

        });
    }
}
