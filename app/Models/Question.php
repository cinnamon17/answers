<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function answer(){

        return $this->hasMany(Answer::class);
    }

    public function likes(){

        return $this->hasMany(Like::class);
    }

    public function dislikes(){

        return $this->hasMany(Dislike::class);
    }
}
