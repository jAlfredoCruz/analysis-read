<?php

namespace App\Interfaces\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Incomplete;

interface IIncompleteRepository{
    public function create( Incomplete $incomplete): Incomplete ;
    public function findIncompletesByBook(int $bookId, int $paginate): LengthAwarePaginator;
    public function update(int $incompleteId, Incomplete $incomplete): Incomplete ;
    public function delete(int $incompleteId): void;
    public function findIncompletesLikeTextAndByBook(string $text, int $bookId, int $paginate): LengthAwarePaginator;
}
