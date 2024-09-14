<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecParameter extends Model
{
    use HasFactory;
    protected $table = 'sec_parameters';
    protected $guarded = [];
}
