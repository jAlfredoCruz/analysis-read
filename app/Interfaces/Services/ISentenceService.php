<?php

namespace App\Interfaces\Services;

use App\Models\Sentence;
use  Illuminate\Pagination\LengthAwarePaginator;

interface ISentenceService {
    public function saveSentence(Sentence $sentence): bool;
    public function updateSentence(int $sentenceId, Sentence $sentence): bool;
    public function deleteSentence(int $sentenceId): void;
    public function filterSentences(string $search, int $bookId, int $paginate): LengthAwarePaginator;
}
