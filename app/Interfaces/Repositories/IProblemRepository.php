<?php

namespace App\Interfaces\Repositories;

use App\Models\Problem;
use Illuminate\Database\Eloquent\Collection;

interface IProblemRepository
{
    public function create(Problem $problem): Problem;
    public function delete(int $problemId): void;
    public function findById(int $id): Problem;
    public function findProblemsByBook(int $bookId): Collection;
    public function findLevelsByBook(int $bookId): Collection;
    public function update(int $problemId, Problem $problem): Problem;
    public function findNumberOfSublevelInProblem(string $level, int $problemId): int;
    public function updateSolution(int $problemId, string $solution): Problem;
}
