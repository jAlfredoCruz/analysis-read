<?php

namespace App\Service;

use App\Interfaces\Repositories\IMisinformationRepository;
use App\Interfaces\Services\IMisinformationService;
use App\Models\Misinformation;
use Illuminate\Pagination\LengthAwarePaginator;

class MisinformationService implements IMisinformationService
{

    public function __construct(
        private IMisinformationRepository $misinformationRepository
    )
    {

    }
	public function saveMisinformation(Misinformation $misinformation): bool
	{
        $newMisinformation = $this->misinformationRepository->create($misinformation);
        if($newMisinformation){
            return true;
        }
        return false;
	}

	public function updateMisinformation(int $misinformationId, Misinformation $misinformation): bool
	{
        $newMisinformation = $this->misinformationRepository->update($misinformationId,$misinformation);
        if($newMisinformation){
            return true;
        }
        return false;
	}

	public function deleteMisinformation(int $misinformationId): void
	{
		$this->misinformationRepository->delete($misinformationId);
	}

	public function filterMisinformations(string $search, int $bookId, int $paginate = 5): LengthAwarePaginator
	{
		if($search == ''){
            return $this->misinformationRepository->findMisinformationsByBook($bookId, $paginate);
        }else{
            return $this->misinformationRepository->findMisinformationsLikeTextAndByBook($search, $bookId, $paginate);
        }
	}
}
