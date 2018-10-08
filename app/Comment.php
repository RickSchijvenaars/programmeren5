<?php

namespace App;

class Comment extends Model
{
    public function photo(){
        return $this->belongsTo(Photo::class);
    }
}
