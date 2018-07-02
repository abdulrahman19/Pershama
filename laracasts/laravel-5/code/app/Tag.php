<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getRouteKeyName() // To make a search by name not id
    {
        return 'name';
    }
}
