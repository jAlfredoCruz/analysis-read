<?php

namespace App\Service;

use App\Interfaces\Repositories\IArgumentRepository;
use App\Interfaces\Services\IArgumentService;
use App\Models\Argument;
use Illuminate\Pagination\LengthAwarePaginator;

class ArgumentService implements IArgumentService
{

    public function __construct(
        private IArgumentRepository $argumentRepository
    )
    {

    }
	public function saveArgument(Argument $argument): bool
	{
        $newArgument = $this->argumentRepository->create($argument);
        if($newArgument){
            return true;
        }
        return false;
	}

	public function updateArgument(int $argumentId, Argument $argument): bool
	{
        $newArgument = $this->argumentRepository->update($argumentId,$argument);
        if($newArgument){
            return true;
        }
        return false;
	}

	public function deleteArgument(int $argumentId): void
	{
		$this->argumentRepository->delete($argumentId);
	}

	public function filterArguments(string $search, int $bookId, int $paginate = 5): LengthAwarePaginator
	{
		if($search == ''){
            return $this->argumentRepository->findArgumentsByBook($bookId, $paginate);
        }else{
            return $this->argumentRepository->findArgumentsLikeTextAndByBook($search, $bookId, $paginate);
        }
	}
}
