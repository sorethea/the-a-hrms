<?php

namespace Sorethea\Hrms\Observers;

use Sorethea\Hrms\Models\Employee;

class EmployeeObserver
{
    /**
     * Handle the Employee "created" event.
     */
    public function created(Employee $employee): void
    {
//        if(empty($employee->avatar_url) || is_null($employee->avatar_url)){
//            $employee->avatar_url = $employee->getFilamentAvatarUrl();
//            $employee->save();
//        }
    }

    /**
     * Handle the Employee "updated" event.
     */
    public function updated(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "deleted" event.
     */
    public function deleted(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "restored" event.
     */
    public function restored(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "force deleted" event.
     */
    public function forceDeleted(Employee $employee): void
    {
        //
    }
}
