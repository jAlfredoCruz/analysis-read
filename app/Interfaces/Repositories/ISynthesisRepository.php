<?php

namespace App\Interfaces\Repositories;

use App\Models\Synthesis;

interface ISynthesisRepository
{
    public function  existByBook(int $bookId): bool;
    public function getByBookId(int $bookId): Synthesis | null;
    public function create(int $bookId, string $synthesis): Synthesis;
    public function update(int $SynthesisId, string $synthesis): Synthesis;

}
?>
