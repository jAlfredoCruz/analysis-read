<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Misinformation;
use Illuminate\Support\Str;

class MisinformationController extends Controller
{
    public function misinformation(Book $book)
    {
        return view('third_level.misinformation.index', [
            'book' => $book
        ]);
    }

    public function create(Book $book)
    {
        return view('third_level.misinformation.create', [
            'book' => $book
        ]);
    }

    public function update(Misinformation $misinformation, Book $book)
    {
        return view('third_level.misinformation.update', [
            'book' => $book,
            'misinformation' => $misinformation
        ]);
    }

    public function read(Misinformation $misinformation, Book $book)
    {
        return view('third_level.misinformation.read', [
            'book' => $book,
            'misinformationText' => Str::markdown($misinformation->text)
        ]);
    }
}
