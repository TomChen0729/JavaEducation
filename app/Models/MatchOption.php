<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchOption extends Model
{   
    use HasFactory;
    protected $guarded = [];
    public function question()
    {
        return $this->BelongsTo(Question::class);
    }
}
