<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionStatus extends Model
{
    use HasFactory;
    protected $table = 'question_status';
    protected $guarded = [];
    
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function questions(){
        return $this->belongsTo(Question::class, 'question_id');
    }
}
