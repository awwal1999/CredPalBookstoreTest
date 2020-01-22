<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'isbn', 'title', 'description', 
    ];

    protected $with = [
        'authors', 'reviews'
    ];

    protected $appends = ['reviews_count'];

    public function authors()
    {
        return $this->belongsToMany('App\Author');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count() ?: 0;
    }
}
