<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KnowledgeCard extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
    public function user_knowledge_cards(): HasMany
    {
        return $this->hasMany(UserKnowledgeCard::class);
    }
    public function pass_course_need_cards(): HasMany
    {
        return $this->hasMany(PassCourseNeedCard::class);
    }
    public function pass_course_get_cards(): HasMany
    {
        return $this->hasMany(PassCourseGetCard::class);
    }

    public function cardtypes(){
        return $this->belongsTo(CardType::class, 'card_type_id');
    }
}
