<?php

namespace App\Interfaces\Repositories;

use App\Models\Sentence;
use Illuminate\Pagination\LengthAwarePaginator;

interface ISentenceRepository{
    public function create(Sentence $sentence): Sentence;
    public function findSentencesByBook(int $bookId, int $paginate): LengthAwarePaginator;
    public function update(int $sentenceId, Sentence $sentence): Sentence;
    public function delete(int $sentenceId): void;
    public function findSentencesLikeTextAndByBook(string $name, int $bookId, int $paginate): LengthAwarePaginator;
}
