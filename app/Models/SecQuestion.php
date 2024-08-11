<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecQuestion extends Model
{
    use HasFactory;

    protected $table = 'sec_questions';
    protected $guarded = [];
}
