<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['fname','name','email','password','profileimage','phone_num','occupation','dateofbirth'];

    public function post(){
        return $this->belongsTo(post::class);
    }

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
