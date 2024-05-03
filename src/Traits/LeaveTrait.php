<?php

namespace Sorethea\Hrms\Traits;

use Carbon\Carbon;
use Sorethea\Hrms\Models\Leave;
use Sorethea\Hrms\Models\Transaction;

trait LeaveTrait
{
    function addWorkingDays($startDate, $workingDays, $holidays = []) {
        $currentDate = Carbon::make($startDate)->copy();
        $addedDays = 0;

        while ($addedDays < $workingDays) {
            $currentDate->addDay();
            if ($currentDate->isWeekday() && !in_array($currentDate->format('Y-m-d'), $holidays)) {
                $addedDays++;
            }
        }

        return $currentDate;
    }

    function workingDays($startDate, $endDate, $holidays = [])
    {
        return Carbon::make($startDate)->diffInDaysFiltered(function (Carbon $date) use ($holidays){
            return $date->isWeekend() || in_array($date->format('Y-m-d'),$holidays);
        },Carbon::make($endDate));

    }
    public function cancel(Leave $leave): void
    {
        if($leave->status == "pending"){
            $leave->status = "cancelled";
            $leave->save();
        }
    }

    public function approve(Leave $leave): void
    {
        if($leave->status=="pending"){
            $balance = $leave->employee->leave_balance??0;
            $lastBalance = $balance - $leave->qty;
            if($leave->paid_leave){
                Transaction::create([
                    "reference_id"=>$leave->id,
                    "reference_type"=>get_class($leave),
                    "balance"=>$balance,
                    "last_balance"=>$lastBalance,
                    "qty"=>$leave->qty,
                    "type"=>"leave",
                    "remark"=>"Approve leave"
                ]);
                $leave->employee->leave_balance = $lastBalance;
                $leave->employee->save();
            }
            $leave->status = "approved";
            $leave->save();
        }

    }

    public function reject(Leave $leave): void
    {
        if($leave->status=="approved"){
            $balance = $leave->employee->leave_balance??0;
            $lastBalance = $balance + $leave->qty;
            if($leave->paid_leave) {
                Transaction::create([
                    "reference_id" => $leave->id,
                    "reference_type" => get_class($leave),
                    "balance" => $balance,
                    "last_balance" => $lastBalance,
                    "qty" => $leave->qty,
                    "type" => "leave",
                    "remark" => "Reject leave"
                ]);
                $leave->employee->leave_balance = $lastBalance;
                $leave->employee->save();
            }
            $leave->status = "rejected";
            $leave->save();
        }
    }
}
