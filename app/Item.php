<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function comments() {
        $this->hasMany(Comment::class);
    }
}
