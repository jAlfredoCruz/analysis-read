<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\GeneralQuestion;
use App\Models\Perfil;

class BookManagerController extends Controller
{
    public function first_level(Book $book)
    {
        return view('first_level.index', [
            'book' => $book
        ]);
    }

    public function extensive(Book $book)
    {
        return view('second_level.extensive', [
            'book' => $book
        ]);
    }

    public function superficial(Book $book)
    {
        return view('second_level.superficial', [
            'book' => $book
        ]);
    }

    public function questions(Book $book)
    {
        return view('second_level.questions', [
            'book' => $book
        ]);
    }

    public function question($question, Book $book)
    {
        return view('second_level.question', [
            'question' => $question,
            'book'=> $book
        ]);
    }

    public function classification(Book $book)
    {
        return view('third_level.classification.index', [
            'book' => $book
        ]);
    }

    public function myCategories(Book $book)
    {
        return view('third_level.classification.my_category', [
            'book' => $book
        ]);
    }

    public function unity(Book $book)
    {
        return view('third_level.unity.index', [
            'book' => $book
        ]);
    }

    public function otherRules(Book $book)
    {
        return view('third_level.other_rules.index', [
            'book' => $book
        ]);
    }


}
