<?php

namespace App\Service;

use App\Interfaces\Repositories\IIlogicRepository;
use App\Interfaces\Services\IIlogicService;
use App\Models\Ilogic;
use Illuminate\Pagination\LengthAwarePaginator;

class IlogicService implements IIlogicService
{

    public function __construct(
        private IIlogicRepository $ilogicRepository
    )
    {

    }
	public function saveIlogic(Ilogic $ilogic): bool
	{
        $newIlogic = $this->ilogicRepository->create($ilogic);
        if($newIlogic){
            return true;
        }
        return false;
	}

	public function updateIlogic(int $ilogicId, Ilogic $ilogic): bool
	{
        $newIlogic = $this->ilogicRepository->update($ilogicId,$ilogic);
        if($newIlogic){
            return true;
        }
        return false;
	}

	public function deleteIlogic(int $ilogicId): void
	{
		$this->ilogicRepository->delete($ilogicId);
	}

	public function filterIlogics(string $search, int $bookId, int $paginate = 5): LengthAwarePaginator
	{
		if($search == ''){
            return $this->ilogicRepository->findIlogicsByBook($bookId, $paginate);
        }else{
            return $this->ilogicRepository->findIlogicsLikeTextAndByBook($search, $bookId, $paginate);
        }
	}
}
