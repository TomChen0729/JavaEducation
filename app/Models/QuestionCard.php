<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionCard extends Model
{
    use HasFactory;
    protected $guard = [];
    protected $table = 'questions_cards';
    public function questions(){
        return $this->belongsTo(Question::class, 'question_id');
    }   
    public function knowledge_cards(){
        return $this->belongsTo(KnowledgeCard::class, 'knowledge_card_id');
    }
}
