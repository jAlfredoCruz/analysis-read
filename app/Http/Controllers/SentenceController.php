<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Sentence;
use Illuminate\Http\Request;

class SentenceController extends Controller
{
    public function sentence(Book $book)
    {
        return view('third_level.sentence.index', [
            'book' => $book
        ]);
    }

    public function create(Book $book)
    {
        return view('third_level.sentence.create', [
            'book' => $book
        ]);
    }

    public function update(Sentence $sentence, Book $book)
    {
        return view('third_level.sentence.update', [
            'sentence' => $sentence,
            'book' => $book
        ]);
    }

    public function read(Sentence $sentence, Book $book)
    {
        return view('third_level.sentence.read', [
            'sentence' => $sentence,
            'book' => $book
        ]);
    }
}
