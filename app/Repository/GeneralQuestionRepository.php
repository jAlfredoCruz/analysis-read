<?php
namespace App\Repository;

use App\Interfaces\Repositories\IGeneralQuestionRepository;
use App\Models\GeneralQuestion;

class GeneralQuestionRepository implements IGeneralQuestionRepository
{
    public function save(int $questionNumber, int $bookId, string $answer): GeneralQuestion
    {
        $exist = $this->exist($questionNumber, $bookId);

        if($exist){
            $generalQuestion = GeneralQuestion::where('book_id', $bookId)
                             ->where('question_number', $questionNumber)
                             ->first();
            $generalQuestion->answer = $answer;
            $generalQuestion->save();
            return $generalQuestion;
        }

        $generalQuestion = new GeneralQuestion();
        $generalQuestion->question_number = $questionNumber;
        $generalQuestion->answer = $answer;
        $generalQuestion->book_id = $bookId;
        $generalQuestion->save();

        return $generalQuestion;

    }

    private function exist(int $questionNumber, int $bookId): bool
    {
        return GeneralQuestion::where('book_id', $bookId)
                                ->where('question_number', $questionNumber)
                                ->count() > 0;
    }

    public function getAnswer(int $bookId, int $questionNumber): string
    {
        $exist = $this->exist($questionNumber, $bookId);

        if(!$exist){
            return '';
        }

        $generalQuestion = GeneralQuestion::where('book_id', $bookId)
        ->where('question_number', $questionNumber)
        ->first();

        return $generalQuestion->answer;
    }
}
