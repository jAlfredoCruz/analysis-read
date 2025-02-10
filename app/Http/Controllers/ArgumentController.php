<?php

namespace App\Http\Controllers;

use App\Models\Argument;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArgumentController extends Controller
{
    public function argument(Book $book)
    {
        return view('third_level.argument.index', [
            'book' => $book
        ]);
    }

    public function create(Book $book)
    {
        return view('third_level.argument.create', [
            'book' => $book
        ]);
    }

    public function update(Argument $argument, Book $book)
    {
        return view('third_level.argument.update', [
            'argument' => $argument,
            'book' => $book
        ]);
    }

    public function read(Argument $argument, Book $book)
    {
        return view('third_level.argument.read', [
            'argumentText' => Str::markdown($argument->text),
            'book' => $book
        ]);
    }
}
