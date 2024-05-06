<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PassFamiliarity extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pass_course_get_cards(): HasMany
    {
        return $this->hasMany(PassCourseGetCard::class);
    }
}
