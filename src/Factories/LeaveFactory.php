<?php

namespace Sorethea\Hrms\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Sorethea\Hrms\Models\Employee;
use Sorethea\Hrms\Models\Holiday;
use Sorethea\Hrms\Models\Leave;
use Sorethea\Hrms\Traits\LeaveTrait;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Sorethea\Hrms\Models\Leave>
 */
class LeaveFactory extends Factory
{
    use LeaveTrait;

    protected $model = Leave::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $qty = random_int(1,5);
        $employeeId = fake()->randomElement(Employee::query()
            ->where("leave_balance",">=",$qty)
            ->where("active",true)
            ->pluck("id")->toArray());
        //$employee = Employee::query()->find($employeeId);
        $publicHolidays = Holiday::query()
            ->whereYear("date",now()->year)
            ->pluck("date")
            ->toArray();
        $workingDates =[];
        $currentDate = Carbon::make(now()->startOfYear());
        $today = Carbon::make(now());
        while ($currentDate <= $today){
            if($currentDate->isWeekday() && !in_array($currentDate->format('Y-m-d'),$publicHolidays)) {
                $workingDates[] = $currentDate->format('Y-m-d');
            }
            $currentDate->addDay();
        }
        $from = fake()->randomElement($workingDates);
        $to = $this->addWorkingDays($from,$qty-1,$publicHolidays);
        //$status = fake()->randomElement(array_keys(config("hrms.leave.status")));
//        if($status!="rejected"){
//            $employee->update(["leave_balance"=>$leaveBalance-$qty]);
//        }
        return [
            "employee_id"=>$employeeId,
            "from" =>$from,
            "to"=>$to,
            "remark"=>fake()->realTextBetween(20,50),
            "type"=>fake()->randomElement(array_keys(config("hrms.leave.type"))),
            "qty"=>$qty,
            "paid_leave"=>true,
        ];
    }
}
