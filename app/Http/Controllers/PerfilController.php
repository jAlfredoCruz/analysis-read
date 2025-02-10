<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Perfil;

class PerfilController extends Controller
{
    public function perfil(Book $book)
    {
        return view('third_level.analysis.index', [
            "book" => $book
        ]);
    }

    public function create(Book $book)
    {
        return view('third_level.analysis.create', [
            'book' => $book
        ]);
    }

    public function update(Perfil $perfil, Book $book)
    {
        return view('third_level.analysis.update',[
            'perfil' => $perfil,
            'book' => $book
        ]);
    }

    public function read(Perfil $perfil, Book $book)
    {
        return view('third_level.analysis.read',[
            'perfil' => $perfil,
            'book' => $book
        ]);
    }



}
