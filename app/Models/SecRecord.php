<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecRecord extends Model
{
    use HasFactory;
    protected $table = 'sec_records';
    protected $guarded = [];
}
