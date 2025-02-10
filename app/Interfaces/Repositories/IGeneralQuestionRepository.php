<?php

namespace App\Interfaces\Repositories;

use App\Models\GeneralQuestion;

interface IGeneralQuestionRepository
{
    public function save(int $book, int $questionNumber, string $answere):  GeneralQuestion;
    public function getAnswer(int $book, int $questionNumber): string;
}
