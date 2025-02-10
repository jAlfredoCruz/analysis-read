<?php

namespace App\Service;

use App\Interfaces\Services\IGeneralQuestionService;
use App\Models\GeneralQuestion;
use App\Interfaces\Repositories\IGeneralQuestionRepository;

class GeneralQuestionService implements IGeneralQuestionService {

    public function __construct(
        private IGeneralQuestionRepository $questionRepository
    )
    {

    }

    public function saveQuestion(int $questionNumber, int $bookId, string $answer): GeneralQuestion
    {
        return $this->questionRepository->save($questionNumber, $bookId, $answer);
    }

    public function getAnswer(int $questionNumber, int $bookId): string
    {
        return $this->questionRepository->getAnswer($questionNumber, $bookId);
    }

}
