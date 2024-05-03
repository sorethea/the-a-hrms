<?php

namespace Sorethea\Hrms\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Sorethea\Hrms\Observers\TransactionObserver;

#[ObservedBy([TransactionObserver::class])]
class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "reference_id",
        "reference_type",
        "balance",
        "last_balance",
        "qty",
        "type",
        "remark",
    ];

    public function reference(): MorphTo{
        return $this->morphTo();
    }
}
