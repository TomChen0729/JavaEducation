<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRecord extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->BelongsTo(User::class,'user_id');
    }

    public function question()
    {
        return $this->BelongsTo(Question::class,'question_id');
    }

    public function userrecorddetails(){
        return $this->hasMany(UserRecordDetail::class);
    }

    public function questionstatus(){
        return $this->hasMany(QuestionStatus::class);
    }
}
