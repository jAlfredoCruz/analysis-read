<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Desinformation;
use Illuminate\Support\Str;

class DesinformationController extends Controller
{
    public function desinformation(Book $book)
    {
        return view('third_level.desinformation.index', [
            'book' => $book
        ]);
    }

    public function create(Book $book)
    {
        return view('third_level.desinformation.create', [
            'book' => $book
        ]);
    }

    public function update(Desinformation $desinformation,
            Book $book)
    {
        return view('third_level.desinformation.update', [
            'book' => $book,
            'desinformation' => $desinformation
        ]);
    }

    public function read(Desinformation $desinformation, Book $book)
    {
        return view('third_level.desinformation.read', [
            'book' => $book,
            'desinformationText' => Str::markdown($desinformation->text)
        ]);
    }
}
