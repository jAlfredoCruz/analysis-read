<?php

namespace App\Interfaces\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Argument;

interface IArgumentRepository{
    public function create(Argument $argument): Argument;
    public function findArgumentsByBook(int $bookId, int $paginate): LengthAwarePaginator;
    public function update(int $argumentId, Argument $argument): Argument;
    public function delete(int $argumentId): void;
    public function findArgumentsLikeTextAndByBook(string $name, int $bookId, int $paginate): LengthAwarePaginator;
}
