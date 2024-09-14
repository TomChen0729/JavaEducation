<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecGame extends Model
{
    use HasFactory;

    protected $table = 'sec_games';
    protected $guarded = [];
}
