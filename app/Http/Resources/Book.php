<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Book extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'isbn' => $this->isbn,
            'title' => $this->title,
            'description' => $this->description,
            'authors' => Author::collection( $this->authors ),
            'reviews' => [
                'avg' => $this->avg_review,
                'count' => $this->reviewsCount,
            ]
        ];
    }
}
