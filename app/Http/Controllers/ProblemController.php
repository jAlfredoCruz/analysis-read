<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    public function problem(Book $book)
    {
        return view('third_level.problem.index', [
            'book' => $book
        ]);
    }

    public function create(Book $book)
    {
        return view('third_level.problem.create', [
            'book' => $book
        ]);
    }

    public function update(Problem $problem, Book $book)
    {
        return view('third_level.problem.update', [
            'book' => $book,
            'problem' => $problem
        ]);
    }

    public function read(Problem $problem, Book $book)
    {
        return view('third_level.problem.read', [
            'book' => $book,
            'problem' => $problem
        ]);
    }

    public function answers(Book $book){
        return view('third_level.problem.answers', [
            'book' => $book
        ]);
    }

    public function updateSolution(Problem $problem, Book $book)
    {
        return view('third_level.problem.edit-solution', [
            'problem' => $problem,
            'book' => $book
        ]);
    }

    public function readSolution(Problem $problem, Book $book)
    {
        return view('third_level.problem.read-solution', [
            'problem' => $problem,
            'book' => $book
        ]);
    }
}
