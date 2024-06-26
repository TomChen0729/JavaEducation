<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRecordDetail extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function userrecord(){
        return $this->belongsTo(UserRecord::class, 'user_record_id');
    }
}
