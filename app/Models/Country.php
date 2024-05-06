<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function knowledge_cards(): HasMany
    {
        return $this->hasMany(KnowledgeCards::class);
    }
}
