<?php

namespace Sorethea\Hrms\Helpers;

use Sorethea\Hrms\Models\Employee;
use Sorethea\Hrms\Models\Leave;
use Sorethea\Hrms\Models\Transaction;

class LeaveHelper
{

    public static function topup(Employee $employee,float $amount): void
    {
        if(!$employee->probatoin && $employee->active){
            Transaction::create([
                "reference_id"=>$employee->id,
                "reference_type"=>get_class($employee),
                "balance"=>$employee->leave_balance,
                "last_balance"=>$employee->leave_balance + $amount,
                "qty"=>$amount,
                "type"=>"topup-leave",
                "remark"=>"Top up leave balance"
            ]);

            $employee->leave_balance +=$amount;
            $employee->save();
        }
    }
    public static function approve(Leave $leave): void
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

    public static function reject(Leave $leave): void
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

    public static function cancel(Leave $leave): void
    {
        if($leave->status == "pending"){
            $leave->status = "cancelled";
            $leave->save();
        }
    }
}
