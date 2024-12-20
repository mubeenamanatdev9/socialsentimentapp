<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    public function postRatings(){
        return $this->belongsTo(postRatings::class);
    }

    public function likes(){
        return $this->belongsTo(likes::class);
    }
    
    public function comments(){
        return $this->belongsTo(comments::class);
    }

    public function shares(){
        return $this->belongsTo(shares::class);
    }
}

