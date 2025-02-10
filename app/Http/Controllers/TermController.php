<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Term;

class TermController extends Controller
{
    public function term(Book $book)
    {
        return view('third_level.terms.index', [
            'book' => $book
        ]);
    }

    public function create(Book $book)
    {
        return view('third_level.terms.create', [
            'book' => $book
        ]);
    }

    public function read(Term $term, Book $book)
    {
        return view('third_level.terms.read', [
            'term' => $term,
            'book' => $book
        ]);
    }

    public function update(Term $term, Book $book)
    {
        return view('third_level.terms.edit', [
            'term' => $term,
            'book' => $book
        ]);
    }


}
