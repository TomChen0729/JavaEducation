<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PassFamiliarity extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'pass_familiarity_id'
    ];
    public function pass_course_get_cards(): HasMany
    {
        return $this->hasMany(PassCourseGetCard::class);
    }
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
