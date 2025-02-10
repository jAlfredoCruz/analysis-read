<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Ilogic;
use Illuminate\Support\Str;

class IlogicController extends Controller
{
    public function ilogic(Book $book)
    {
        return view('third_level.ilogic.index', [
            'book' => $book
        ]);
    }

    public function create(Book $book)
    {
        return view('third_level.ilogic.create', [
            'book' => $book
        ]);
    }

    public function update(Ilogic $ilogic, Book $book)
    {
        return view('third_level.ilogic.update', [
            'book' => $book,
            'ilogic' => $ilogic
        ]);
    }

    public function read(Ilogic $ilogic, Book $book)
    {
        return view('third_level.ilogic.read', [
            'book' => $book,
            'ilogicText' => Str::markdown($ilogic->text)
        ]);
    }
}
