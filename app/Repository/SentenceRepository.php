<?php

namespace App\Repository;

use App\Interfaces\Repositories\ISentenceRepository;
use App\Models\Sentence;
use Illuminate\Pagination\LengthAwarePaginator;

class SentenceRepository implements ISentenceRepository {

    public function create(Sentence $newSentence): Sentence {

       $sentence = new Sentence();
       $sentence->text = $newSentence->text;
       $sentence->book_id = $newSentence->book_id;
       $sentence->save();

       return $sentence;
    }

    public function findSentencesByBook(int $bookId, int $paginate): LengthAwarePaginator {
        return Sentence::where('book_id', $bookId)->paginate($paginate);
    }

    public function update(int $sentenceId, Sentence $newSentence): Sentence
    {

       $sentence = Sentence::find($sentenceId);
       $sentence->text = $newSentence->text;
       $sentence->save();

       return $sentence;
    }

    public function delete(int $sentenceId): void
    {
        $sentence = Sentence::find($sentenceId);
        $sentence->delete();
    }

    public function findSentencesLikeTextAndByBook(string $text, int $bookId, int $paginate): LengthAwarePaginator
    {
        return Sentence::where('book_id', $bookId)
                ->where('text', 'like', "%$text%")
                ->paginate($paginate);
    }
}
