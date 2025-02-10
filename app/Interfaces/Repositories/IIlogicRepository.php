<?php

namespace App\Interfaces\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Ilogic;

interface IIlogicRepository{
    public function create( Ilogic $ilogic): Ilogic ;
    public function findIlogicsByBook(int $bookId, int $paginate): LengthAwarePaginator;
    public function update(int $ilogicId, Ilogic $ilogic): Ilogic ;
    public function delete(int $ilogicId): void;
    public function findIlogicsLikeTextAndByBook(string $text, int $bookId, int $paginate): LengthAwarePaginator;
}
