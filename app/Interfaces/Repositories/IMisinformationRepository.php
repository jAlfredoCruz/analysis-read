<?php

namespace App\Interfaces\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Misinformation;

interface IMisinformationRepository{
    public function create( Misinformation $misinformation): Misinformation ;
    public function findMisinformationsByBook(int $bookId, int $paginate): LengthAwarePaginator;
    public function update(int $misinformationId, Misinformation $misinformation): Misinformation ;
    public function delete(int $misinformationId): void;
    public function findMisinformationsLikeTextAndByBook(string $text, int $bookId, int $paginate): LengthAwarePaginator;
}
