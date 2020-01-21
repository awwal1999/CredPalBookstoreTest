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

    protected $appends = ['ratings'];

    public function authors()
    {
        return $this->belongsToMany('App\Author');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public static function avg_review()
    {
        return $this->reviews()->avg('review');
    }

    public function getRatingsAttribute()
    {
        return $this->reviews()->avg('review') ?: 0;
    }

    public function reviewsCount()
    {
    return $this->reviews()
        ->selectRaw('book_id, count(*) as aggregate')
        ->groupBy('book_id');
    }
}
