<?php

namespace App\Service;

use App\Interfaces\Repositories\IDesinformationRepository;
use App\Interfaces\Services\IDesinformationService;
use App\Models\Desinformation;
use Illuminate\Pagination\LengthAwarePaginator;

class DesinformationService implements IDesinformationService
{

    public function __construct(
        private IDesinformationRepository $desinformationRepository
    )
    {

    }
	public function saveDesinformation(Desinformation $desinformation): bool
	{
        $newDesinformation = $this->desinformationRepository->create($desinformation);
        if($newDesinformation){
            return true;
        }
        return false;
	}

	public function updateDesinformation(int $desinformationId, Desinformation $desinformation): bool
	{
        $newDesinformation = $this->desinformationRepository->update($desinformationId,$desinformation);
        if($newDesinformation){
            return true;
        }
        return false;
	}

	public function deleteDesinformation(int $desinformationId): void
	{
		$this->desinformationRepository->delete($desinformationId);
	}

	public function filterDesinformations(string $search, int $bookId, int $paginate = 5): LengthAwarePaginator
	{
		if($search == ''){
            return $this->desinformationRepository->findDesinformationsByBook($bookId, $paginate);
        }else{
            return $this->desinformationRepository->findDesinformationsLikeTextAndByBook($search, $bookId, $paginate);
        }
	}
}
