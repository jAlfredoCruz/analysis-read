<?php

namespace App\Interfaces\Services;

use App\Models\Argument;
use  Illuminate\Pagination\LengthAwarePaginator;

interface IArgumentService {
    public function saveArgument(Argument $argument): bool;
    public function updateArgument(int $argumentId, Argument $argument): bool;
    public function deleteArgument(int $argumentId): void;
    public function filterArguments(string $search, int $bookId, int $paginate): LengthAwarePaginator;
}
