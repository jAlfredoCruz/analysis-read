<?php

namespace App\Interfaces\Services;

use App\Models\Synthesis;

interface ISynthesisService
{
    public function getSynthesisByBookId(int $bookId): Synthesis | null;
    public function saveSynthesis(int $bookId, string $synthesis): void;
    public function updateSynthesis(int $synthesisId, string $synthesis): void;
    public function existSynthesisBook(int $bookId): bool;
}
