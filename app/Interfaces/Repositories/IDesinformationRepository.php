<?php

namespace App\Interfaces\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Desinformation;

interface IDesinformationRepository{
    public function create( Desinformation $desinformation): Desinformation ;
    public function findDesinformationsByBook(int $bookId, int $paginate): LengthAwarePaginator;
    public function update(int $desinformationId, Desinformation $desinformation): Desinformation ;
    public function delete(int $desinformationId): void;
    public function findDesinformationsLikeTextAndByBook(string $text, int $bookId, int $paginate): LengthAwarePaginator;
}
