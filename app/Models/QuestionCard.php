<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionCard extends Model
{
    use HasFactory;
    protected $guard = [];
    protected $table = 'questions_cards';
}
