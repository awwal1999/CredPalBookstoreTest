<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use Illuminate\Http\Request;
use App\Http\Resources\Book as BookResource;

class BooksController extends Controller
{
    protected $sortColumn;
    protected $sortDirection;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->sortColumn = request()->has('sortColumn') ?: 'id';
        $this->sortDirection = request()->has('sortDirection') ?: 'DESC';

        if (request()->has('title')) {
            return $this->seachByTitle();
        }

        if (request()->has('authors')) {
            return $this->searchByAuthor();
        }
        return BookResource::collection(Book::orderBy($this->sortColumn, $this->sortDirection)->paginate(25));
    }


    public function store()
    {
        return 'ilovr you';
    }
    protected function seachByTitle()
    {
        return BookResource::collection(Book::where('title',request('title'))->orderBy($this->sortColumn, $this->sortDirection)->paginate(25));
    }
    protected function searchByAuthor()
    {
        $authors = explode(',',request('authors'));
            $books = Book::whereHas('authors', function ($q) use ($authors) {
                $q->whereIn('author_id', $authors);
            })->paginate(25);
            return BookResource::collection($books);
    }
}
