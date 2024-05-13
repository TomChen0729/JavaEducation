<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mockery\Generator\StringManipulation\Pass\Pass;

class MainLine extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function pass_course_need_cards(): HasMany
    {
        return $this->hasMany(PassCourseNeedCard::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
