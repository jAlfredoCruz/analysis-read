<?php

namespace App\Repository;

use App\Interfaces\Repositories\IProblemRepository;
use App\Models\Problem;
use Illuminate\Database\Eloquent\Collection;

class ProblemRepository implements IProblemRepository
{
	public function create(Problem $myProblem): Problem
	{
		$problem = new Problem();
        $problem->name = $myProblem->name;
        $problem->level = $myProblem->level;
        $problem->text = $myProblem->text;
        $problem->book_id = $myProblem->book_id;
        $problem->save();

        return $problem;
	}

	public function delete(int $problemId): void
	{
        $problem = Problem::find($problemId);
        $problem->delete();
	}

	public function findById(int $id): Problem
	{
		return Problem::find($id);
	}

	public function findLikeNameAndLevel(string $name, string $level, int $bookId): Collection
	{
		$problems = Problem::where('name', 'like', "%$name%")
            ->orWhere('level', 'like', "%$level%")
            ->where('book_id', $bookId)
            ->orderBy('level')
            ->get();

        return $problems;
	}

    public function findProblemsByBook(int $bookId): Collection
    {
        return Problem::where('book_id', $bookId)->get();
    }

    public function findLevelsByBook(int $bookId): Collection
    {
        return Problem::select('level')
            ->where('book_id', $bookId)
            ->groupBy('level')
            ->get();
    }

	public function update(int $problemId, Problem $myProblem): Problem
	{
		$problem = Problem::find($problemId);
        $problem->name = $myProblem->name;
        $problem->level = $myProblem->level;
        $problem->text = $myProblem->text;
        $problem->save();

        return $problem;
	}

    public function findNumberOfSublevelInProblem(string $level, int $problemId): int
    {
        $subLevelCount = Problem::where('level','LIKE', '%'.$level.'%')
                            ->where('id', '!=', $problemId)
                            ->count();
        return $subLevelCount;
    }

    public function updateSolution(int $problemId, string $solution): Problem
    {
        $problem = Problem::find($problemId);
        $problem->solution = $solution;
        $problem->save();

        return $problem;
    }
}
