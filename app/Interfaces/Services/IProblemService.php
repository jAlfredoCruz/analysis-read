<?php

namespace App\Interfaces\Services;

use App\Models\Problem;
use Illuminate\Database\Eloquent\Collection;

interface IProblemService
{
    public function saveProblem(Problem $problem): bool;
    public function saveSolution(int $problemId, string $text): bool;
    public function updateProblem(int $problemId, Problem $problem): bool;
    public function deleteProblem(int $problemId);
    public function getProblem(int $problemId): Problem;
    public function getProblemsByBook(int $bookId): Collection;
    public function getLevelsByBook(int $bookId): Collection;
    public function filterProblems(string $search, Collection $problems, int $bookId): Collection;
    public function hasSubordinate(Problem $problem): bool;
}
