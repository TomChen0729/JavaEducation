<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardType extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function knowledgecards(){
        return $this->hasMany(KnowledgeCard::class);
    }
}
