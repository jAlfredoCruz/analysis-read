<?php

namespace App\Interfaces\Services;

use App\Models\GeneralQuestion;

interface IGeneralQuestionService
{
    public function saveQuestion(int $questionNumber, int $bookId, string $answer): GeneralQuestion;
    public function getAnswer(int $questionNumber, int $bookId): string;
}
