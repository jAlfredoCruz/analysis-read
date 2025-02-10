<?php

namespace App\Livewire\SecondLevel;

use App\Interfaces\Services\IGeneralQuestionService;
use App\Models\Book;
use App\Models\GeneralQuestion;
use App\Service\GeneralQuestionService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Question extends Component
{

    public Book $book;
    public int $questionNumber;
    private IGeneralQuestionService $questionService;
    #[Validate('required')]
    public string $answer = '';

    public function boot(
        GeneralQuestionService $questionService
    )
    {
        $this->questionService = $questionService;
    }

    public function mount(int $question, Book $book)
    {
        $this->book = $book;
        $this->questionNumber = $question;
        $this->answer = $this->questionService->getAnswer($question, $book->id);
    }

    public function save()
    {
        $this->questionService->saveQuestion($this->questionNumber, $this->book->id, $this->answer);

        return $this->redirect('manager/second_level/questions/'.$this->book->id);

    }

    public function render()
    {
        return view('livewire.second-level.question');
    }
}
