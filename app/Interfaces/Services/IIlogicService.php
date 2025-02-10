<?php

namespace App\Interfaces\Services;

use App\Models\Ilogic;
use  Illuminate\Pagination\LengthAwarePaginator;

interface IIlogicService {
    public function saveIlogic(Ilogic $ilogic): bool;
    public function updateIlogic(int $ilogicId, Ilogic $ilogic): bool;
    public function deleteIlogic(int $ilogicId): void;
    public function filterIlogics(string $search, int $bookId, int $paginate): LengthAwarePaginator;
}
