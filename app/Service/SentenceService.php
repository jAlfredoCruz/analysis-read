<?php

namespace App\Service;

use App\Interfaces\Repositories\ISentenceRepository;
use App\Interfaces\Services\ISentenceService;
use App\Models\Sentence;
use Illuminate\Pagination\LengthAwarePaginator;

class SentenceService implements ISentenceService
{

    public function __construct(
        private ISentenceRepository $sentenceRepository
    )
    {

    }
	public function saveSentence(Sentence $sentence): bool
	{
        $newSentence = $this->sentenceRepository->create($sentence);
        if($newSentence){
            return true;
        }
        return false;
	}

	public function updateSentence(int $sentenceId, Sentence $sentence): bool
	{
        $newSentence = $this->sentenceRepository->update($sentenceId,$sentence);
        if($newSentence){
            return true;
        }
        return false;
	}

	public function deleteSentence(int $sentenceId): void
	{
		$this->sentenceRepository->delete($sentenceId);
	}

	public function filterSentences(string $search, int $bookId, int $paginate = 5): LengthAwarePaginator
	{
		if($search == ''){
            return $this->sentenceRepository->findSentencesByBook($bookId, $paginate);
        }else{
            return $this->sentenceRepository->findSentencesLikeTextAndByBook($search, $bookId, $paginate);
        }
	}
}
