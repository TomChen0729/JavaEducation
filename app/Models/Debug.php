<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debug extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function debug_records(){
        return $this->hasMany(DebugRecord::class);
    }
}
