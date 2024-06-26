<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }
    public function reorganization_options(): HasMany
    {
        return $this->hasMany(ReorganizationOption::class);
    }
    public function match_options(): HasMany
    {
        return $this->hasMany(MatchOption::class);
    }
    public function user_records(): HasMany
    {
        return $this->hasMany(UserRecord::class);
    }
    public function question_status(): HasMany
    {
        return $this->hasMany(QuestionStatus::class);
    }
}
