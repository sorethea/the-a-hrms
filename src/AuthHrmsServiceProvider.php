<?php

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Sorethea\Hrms\Models\Employee;
use Sorethea\Hrms\Models\Holiday;
use Sorethea\Hrms\Models\Leave;
use Sorethea\Hrms\Models\OrganizationalUnit;
use Sorethea\Hrms\Models\Transaction;
use Sorethea\Hrms\Policies\EmployeePolicy;
use Sorethea\Hrms\Policies\HolidayPolicy;
use Sorethea\Hrms\Policies\LeavePolicy;
use Sorethea\Hrms\Policies\OrganizationalUnitPolicy;
use Sorethea\Hrms\Policies\TransactionPolicy;

class AuthHrmsServiceProvider extends ServiceProvider
{

    protected $policies = [
        Employee::class=>EmployeePolicy::class,
        Holiday::class=>HolidayPolicy::class,
        Leave::class=>LeavePolicy::class,
        OrganizationalUnit::class=>OrganizationalUnitPolicy::class,
        Transaction::class=>TransactionPolicy::class,
    ];
    public function register(): void
    {

    }

    public function boot(): void
    {
    }
}
