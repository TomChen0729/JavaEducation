<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }
    public function rewriting_options(): HasMany
    {
        return $this->hasMany(RewritingOption::class);
    }
    public function match_options(): HasMany
    {
        return $this->hasMany(MatchOption::class);
    }
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
