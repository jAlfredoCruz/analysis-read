<?php

namespace App\Service;

use App\Interfaces\Repositories\ITermRepository;
use App\Interfaces\Services\ITermService;
use App\Models\Term;
use Illuminate\Pagination\LengthAwarePaginator;

class TermService implements ITermService
{

    public function __construct(
        private ITermRepository $termRepository
    )
    {

    }
	public function saveTerm(Term $term): bool
	{
        $newTerm = $this->termRepository->create($term);
        if($newTerm){
            return true;
        }
        return false;
	}

	public function updateTerm(int $termId, Term $term): bool
	{
        $newTerm = $this->termRepository->update($termId,$term);
        if($newTerm){
            return true;
        }
        return false;
	}

	public function deleteTerm(int $termId): void
	{
		$this->termRepository->delete($termId);
	}

	public function filterTerms(string $search, int $bookId, int $paginate = 5): LengthAwarePaginator
	{
		if($search == ''){
            return $this->termRepository->findTermsByBook($bookId, $paginate);
        }else{
            return $this->termRepository->findTermsLikeNameAndByBook($search, $bookId, $paginate);
        }
	}
}
