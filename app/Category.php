<?php

namespace App;

class Category extends Model
{
    public function photos(){
        return $this->hasMany(Photo::class);
    }
}
