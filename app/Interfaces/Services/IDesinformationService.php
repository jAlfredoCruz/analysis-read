<?php

namespace App\Interfaces\Services;

use App\Models\Desinformation;
use  Illuminate\Pagination\LengthAwarePaginator;

interface IDesinformationService {
    public function saveDesinformation(Desinformation $desinformation): bool;
    public function updateDesinformation(int $desinformationId, Desinformation $desinformation): bool;
    public function deleteDesinformation(int $desinformationId): void;
    public function filterDesinformations(string $search, int $bookId, int $paginate): LengthAwarePaginator;
}
