<?php

namespace Sorethea\Hrms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class OrganizationalUnit extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'type',
        'parent_id',
        'is_brand',
        'logo',
    ];

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(self::class);
    }

    public function landmarks(): MorphMany{
        return $this->morphMany(Landmark::class,"model");
    }
}
