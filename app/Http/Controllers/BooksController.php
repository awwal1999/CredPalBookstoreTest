<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Resources\Book as BookResource;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sortColumn = request()->has('sortColumn') ?: 'id';
        $sortDirection = request()->has('sortDirection') ?: 'DESC';

        return BookResource::collection(Book::orderBy($sortColumn, $sortDirection)->paginate(25));
    }


    public function store()
    {
        return 'ilovr you';
    }
}
