<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Incomplete;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IncompleteController extends Controller
{
    public function incomplete(Book $book)
    {
        return view('third_level.incomplete.index', [
            'book' => $book
        ]);
    }

    public function create(Book $book)
    {
        return view('third_level.incomplete.create', [
            'book' => $book
        ]);
    }

    public function update(Incomplete $incomplete, Book $book)
    {
        return view('third_level.incomplete.update', [
            'book' => $book,
            'incomplete' => $incomplete
        ]);
    }

    public function read(Incomplete $incomplete, Book $book)
    {
        return view('third_level.incomplete.read', [
            'book' => $book,
            'incompleteText' => Str::markdown($incomplete->text)
        ]);
    }



}
