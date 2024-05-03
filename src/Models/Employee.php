<?php

namespace Sorethea\Hrms\Models;

use Carbon\Carbon;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Sorethea\Hrms\Observers\EmployeeObserver;

#[ObservedBy([EmployeeObserver::class])]
class Employee extends Model implements HasAvatar
{
    use HasFactory;

    protected $fillable =[
        "name",
        "name_kh",
        "avatar_url",
        "date_of_birth",
        "position",
        "gender",
        "hired_date",
        "code",
        "last_working_date",
        "probation",
        "dependencies",
        "educations",
        "skills",
        "work_experiences",
        "attached_files",
        "active",
    ];
    protected $casts =[
        "dependencies"=>"array",
        "educations"=>"array",
        "skills"=>"array",
        "attached_files"=>"array",
        "work_experiences"=>"array",
    ];
    protected $appends =[
        "probation",
        //"name_kh"
    ];
//    public function getProbationAttribute(): bool {
//        return Carbon::make($this->hired_date)->between(now()->subMonth(3),now());
//    }
//    public function getNameKhAttribute(): string{
//        return $this->properties->name_kh??"";
//    }
//    public function setNameKhAttribute(): string{
//        $this->properties->name_kh = request()->get("name_kh");
//    }

    protected function probation(): Attribute{
        return Attribute::make(
            get: fn():bool=>Carbon::make($this->hired_date)->between(now()->subMonth(3),now()),
        );
    }

//    protected function nameKh(): Attribute{
//        return Attribute::make(
//            get: fn()=>$this->properties->name_kh??'',
//            set: fn(string $value, array $attributes)=>new Property(
//               $attributes["name_kh"] = $value
//            ),
//        );
//    }

    public function manager():BelongsTo{
        return $this->belongsTo(self::class,'report_to','id');
    }

    public function ou(): BelongsTo{
        return $this->belongsTo(OrganizationalUnit::class);
    }

    public function holidays(): BelongsToMany{
        return $this->belongsToMany(Holiday::class,'employee_has_holidays');
    }

    public function leaves(): HasMany{
        return $this->hasMany(Leave::class);
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return !empty($this->avatar_url) && !is_null($this->avatar_url)
            ?$this->avatar_url
            :config("filament-avatar.providers.ui-avatar.url")."?name=".urlencode($this->name);
    }
}
