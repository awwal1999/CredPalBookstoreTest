<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $with = [
        'authors', 'reviews'
    ];
    public function authors()
    {
        return $this->belongsToMany('App\Author');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
}
