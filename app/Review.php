<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\ReviewCreated;

class Review extends Model
{
    protected $fillable = [
        'review', 'comment', 'user_id'
    ];

    protected $with = [
        'user'
    ];

    protected static function boot() {
        parent::boot();

        static::created(function ($review) {
            $book = Book::where('id', $review->book_id)
                        ->update(['avg_review' => round(Review::where('book_id',$review->book_id)->avg('review'), 1)]);
            ;
        });
    }

    public function book()
    {
        return $this->belongsTo('App\Book');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
