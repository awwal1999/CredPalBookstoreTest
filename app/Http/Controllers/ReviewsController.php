<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Resources\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function store(Book $book)
    {
        $this->validateReview();

        $review = $book->reviews()->create([
            'review' => request('review'),
            'comment' => request('comment'),
            'user_id' => auth()->user()->id,
        ]);
        
        return response()->json(new Review($review) , 201);
    }

    public function validateReview()
    {
        return request()->validate([
            'review' => 'required|integer|min:1|max:10',
            'comment' => 'required|string',
        ]);
    }
}
