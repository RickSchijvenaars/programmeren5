<?php

namespace App;

class Photo extends Model
{
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
