<?php

namespace Sorethea\Hrms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HolidayDate extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "date",
        "holiday_id"
    ];

    public function holiday(): BelongsTo{

        return $this->belongsTo(Holiday::class);

    }
}
