<?php

namespace Sorethea\Hrms\Resources\EmployeeResource\Widgets;

use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Sorethea\Hrms\Models\Employee;
use Sorethea\Hrms\Resources\EmployeeResource\Pages\ListEmployees;

class EmployeeStat extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    public function getTablePage(): string
    {
        return ListEmployees::class;
    }

    public array $tableColumnSearches = [];

    protected function getStats(): array
    {
        $employeeData = Trend::model(Employee::class)
            ->dateColumn('hired_date')
            ->between(
                now()->subYear(),
                now())
            ->perMonth()
            ->count();
        $hiredInThisMonth = $this->getPageTableQuery()
            ->where("active",true)
            ->whereBetween("hired_date",[now()->startOfMonth(),now()->endOfMonth()])
            ->count();
        $probationEmployees = $this->getPageTableQuery()
            ->where("active",true)
            ->where("hired_date",">=",now()->subMonth(3))
            ->where("hired_date","<=",now())
            ->count();
        $activeEmployees = $this->getPageTableQuery()
            ->where("active",true)
            ->count();
        return [
            Stat::make("Total Active Employees",$activeEmployees)
                ->color("success")
                ->description("Hired in this month {$hiredInThisMonth} employees")
                ->descriptionColor("info")
                ->chart(
                    $employeeData
                        ->map(fn(TrendValue $value) => $value->aggregate)
                        ->toArray()
                ),
            Stat::make("Total Employee In Probation", $probationEmployees)
                ->color("primary"),
            //Stat::make("Total employees hired in this month",$hiredInThisMonth),
        ];
    }
}
