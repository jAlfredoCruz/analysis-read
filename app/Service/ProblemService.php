<?php

namespace App\Service;

use App\Interfaces\Repositories\IProblemRepository;
use App\Interfaces\Services\IProblemService;
use App\Models\Problem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class ProblemService implements IProblemService {

    public function __construct(
        private IProblemRepository $problemRepository
    ) {

    }

	public function saveProblem(Problem $problem): bool
    {
        $problem = $this->problemRepository->create($problem);
        if(!$problem) {
            return false;
        }
		return true;
	}

    public function saveSolution(int $problemId, string $text): bool
    {
       $problem = $this->problemRepository->updateSolution($problemId, $text);

       if($problem){
            return true;
       }

       return false;
    }

	public function deleteProblem(int $problemId) {
		$this->problemRepository->delete($problemId);
	}

	public function getProblem(int $problemId): Problem {
        return $this->problemRepository->findById($problemId);
	}

	public function getProblemsByBook(int $bookId): Collection
    {
        return $this->problemRepository->findProblemsByBook($bookId);
    }

	public function updateProblem(int $problemId, Problem $problem): bool {
        $problem = $this->problemRepository->update($problemId, $problem);
        if(!$problem) {
            return false;
        }
        return true;
	}

	public function getLevelsByBook(int $bookId): Collection {
		return $this->problemRepository->findLevelsByBook($bookId);
	}

    public function hasSubordinate(Problem $problem): bool
    {
       $number = $this->problemRepository->
                        findNumberOfSublevelInProblem($problem->level, $problem->id);
       return $number > 0;
    }

    public function filterProblems(string $search, Collection $problems, int $bookId): Collection
    {
        if($search == '') {
            return $problems;
        }else{
            return  $problems
                        ->filter(function(Problem $problem) use ($search) {
                            return Str::contains(strtolower($problem->level),strtolower($search)) ||
                                    Str::contains(strtolower($problem->name),strtolower($search));
                        });
        }
    }
}
