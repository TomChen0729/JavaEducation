<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebugRecord extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'debug_records';
    public function debug(){
        return $this->belongsTo(Debug::class, 'debug_id');
    }
}
