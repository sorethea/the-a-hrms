<?php

namespace Sorethea\Hrms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Landmark extends Model
{
    use HasFactory;
    protected $fillable =[
        "code",
        "name",
        "contact_number",
        "address",
        ];

    protected $casts =[
        "code"=>"string",
        "name"=>"string",
        "contact_number"=>"object",
        "address"=>"string",
    ];
    public function model(): MorphTo {
        return $this->morphTo();
    }

}
