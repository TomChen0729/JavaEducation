<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionStatus extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function userrecord(){
        return $this->belongsTo(UserRecord::class, 'user_id', 'question_id');
    }
}
