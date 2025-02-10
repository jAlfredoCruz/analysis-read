<?php

namespace App\Interfaces\Services;

use App\Models\Term;
use  Illuminate\Pagination\LengthAwarePaginator;

interface ITermService {
    public function saveTerm(Term $term): bool;
    public function updateTerm(int $termId, Term $term): bool;
    public function deleteTerm(int $termId): void;
    public function filterTerms(string $search, int $bookId, int $paginate): LengthAwarePaginator;
}
