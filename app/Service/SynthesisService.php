<?php

namespace App\Service;

use App\Interfaces\Services\ISynthesisService;
use App\Interfaces\Repositories\ISynthesisRepository;
use App\Models\Synthesis;

class SynthesisService implements ISynthesisService
{

    public function __construct(
        private ISynthesisRepository $synthesisRepository)
    {

    }

    public function getSynthesisByBookId(int $bookId): Synthesis | null
    {
        return $this->synthesisRepository->getByBookId($bookId);
    }

    public function saveSynthesis(int $bookId, string $synthesis): void
    {
        $this->synthesisRepository->create($bookId, $synthesis);
    }

    public function updateSynthesis(int $synthesisId, string $synthesis): void
    {
        $this->synthesisRepository->update($synthesisId, $synthesis);
    }

    public function existSynthesisBook(int $bookId): bool
    {
        return $this->synthesisRepository->existByBook($bookId);
    }

}
