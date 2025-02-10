<?php

namespace App\Interfaces\Services;

use App\Models\Incomplete;
use  Illuminate\Pagination\LengthAwarePaginator;

interface IIncompleteService {
    public function saveIncomplete(Incomplete $incomplete): bool;
    public function updateIncomplete(int $incompleteId, Incomplete $incomplete): bool;
    public function deleteIncomplete(int $incompleteId): void;
    public function filterIncompletes(string $search, int $bookId, int $paginate): LengthAwarePaginator;
}
