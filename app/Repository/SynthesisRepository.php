<?php

namespace App\Repository;

use App\Interfaces\Repositories\ISynthesisRepository;
use App\Models\Synthesis;
use App\Models\Book;

class SynthesisRepository implements ISynthesisRepository
{
    // Implement the methods defined in ISynthesisRepository interface

    public function  existByBook(int $bookId): bool
    {
       $book = Book::find($bookId);

        return $book->synthesis() != null ? true : false;
    }

    public function getByBookId(int $bookId): Synthesis | null
    {
        return Synthesis::where('book_id', $bookId)->first();
    }

    public function create(int $bookId, string $text): Synthesis
    {
        $synthesis = new Synthesis();
        $synthesis->book_id = $bookId;
        $synthesis->text = $text;
        $synthesis->save();

        return $synthesis;
    }

    public function update(int $SynthesisId, string $text): Synthesis
    {
        $synthesis = Synthesis::find($SynthesisId);
        $synthesis->text = $text;
        $synthesis->save();

        return $synthesis;
    }
}
