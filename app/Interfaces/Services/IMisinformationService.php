<?php

namespace App\Interfaces\Services;

use App\Models\Misinformation;
use  Illuminate\Pagination\LengthAwarePaginator;

interface IMisinformationService {
    public function saveMisinformation(Misinformation $misinformation): bool;
    public function updateMisinformation(int $misinformationId, Misinformation $misinformation): bool;
    public function deleteMisinformation(int $misinformationId): void;
    public function filterMisinformations(string $search, int $bookId, int $paginate): LengthAwarePaginator;
}
