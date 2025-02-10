<?php

namespace App\Livewire\SecondLevel;

use App\Models\Book;
use App\Service\GeneralQuestionService;
use App\Interfaces\Services\IGeneralQuestionService;
use Livewire\Component;

class Questions extends Component
{
    public Book $book;
    public bool $open1 = false;
    public bool $open2 = false;
    public bool $open3 = false;
    public bool $open4 = false;

    public string $answer1 = '';
    public string $answer2 = '';
    public string $answer3 = '';
    public string $answer4 = '';

    private IGeneralQuestionService $questionService;

    public function boot(
        GeneralQuestionService $questionService
    )
    {
        $this->questionService = $questionService;
    }

    public function mount(Book $book)
    {
        $this->book = $book;
        $this->answer1 = $this->questionService->getAnswer(1, $this->book->id);
        $this->answer2 = $this->questionService->getAnswer(2, $this->book->id);
        $this->answer3 = $this->questionService->getAnswer(3, $this->book->id);
        $this->answer1 = $this->questionService->getAnswer(4, $this->book->id);
    }

    public function openModal1()
    {
        $this->open1 = true;
    }

    public function openModal2()
    {
        $this->open2 = true;
    }

    public function openModal3()
    {
        $this->open3 = true;
    }

    public function openModal4()
    {
        $this->open4 = true;
    }

    public function render()
    {
        return view('livewire.second-level.questions');
    }
}
