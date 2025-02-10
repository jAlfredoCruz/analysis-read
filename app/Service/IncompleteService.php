<?php

namespace App\Service;

use App\Interfaces\Repositories\IIncompleteRepository;
use App\Interfaces\Services\IIncompleteService;
use App\Models\Incomplete;
use Illuminate\Pagination\LengthAwarePaginator;

class IncompleteService implements IIncompleteService
{

    public function __construct(
        private IIncompleteRepository $incompleteRepository
    )
    {

    }
	public function saveIncomplete(Incomplete $incomplete): bool
	{
        $newIncomplete = $this->incompleteRepository->create($incomplete);
        if($newIncomplete){
            return true;
        }
        return false;
	}

	public function updateIncomplete(int $incompleteId, Incomplete $incomplete): bool
	{
        $newIncomplete = $this->incompleteRepository->update($incompleteId,$incomplete);
        if($newIncomplete){
            return true;
        }
        return false;
	}

	public function deleteIncomplete(int $incompleteId): void
	{
		$this->incompleteRepository->delete($incompleteId);
	}

	public function filterIncompletes(string $search, int $bookId, int $paginate = 5): LengthAwarePaginator
	{
		if($search == ''){
            return $this->incompleteRepository->findIncompletesByBook($bookId, $paginate);
        }else{
            return $this->incompleteRepository->findIncompletesLikeTextAndByBook($search, $bookId, $paginate);
        }
	}
}
