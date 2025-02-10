<?php

namespace App\Interfaces\Repositories;

use App\Models\Term;
use Illuminate\Pagination\LengthAwarePaginator;

interface ITermRepository {
    public function create(Term $term): Term;
    public function findTermsByBook(int $bookId, int $paginate): LengthAwarePaginator;
    public function update(int $termId, Term $term): Term;
    public function delete(int $termId): void;
    public function findTermsLikeNameAndByBook(string $name, int $bookId, int $paginate): LengthAwarePaginator;
}
