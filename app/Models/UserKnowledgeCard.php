<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKnowledgeCard extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'user_knowledge_cards';
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
