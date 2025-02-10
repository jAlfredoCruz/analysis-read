<?php

namespace App\Livewire\Problem;

use App\Interfaces\Services\IProblemService;
use Livewire\Component;
use App\Models\Book;
use App\Service\ProblemService;
use Illuminate\Database\Eloquent\Collection;

class Problems extends Component
{
    public Book $book;
    public Collection $problems;
    public bool $showSuggestionModal;
    public bool $showAnswerSuggestionModal;
    public string $search = '';
    public bool $answer;
    public string $route = 'read_problem';

    private IProblemService $problemService;

    public function boot(
        ProblemService $problemService
    )
    {
        $this->problemService = $problemService;
    }

    public function mount(Book $book, bool $answer = false)
    {
        $this->book = $book;
        $this->problems = $this->problemService->getProblemsByBook($book->id);
        $this->answer = $answer;
        if($answer){
            $this->route = 'read_answer';
        }
    }

    public function openSuggestionModal()
    {
        $this->showSuggestionModal = true;
    }

    public function openAnswerSuggestionModal()
    {
        $this->showAnswerSuggestionModal = true;
    }

    public function closeSuggestionModal()
    {
        $this->showSuggestionModal = false;
    }

    public function closeAnswerSuggestionModal()
    {
        $this->showAnswerSuggestionModal = false;
    }

    public function createProblem()
    {
        return redirect()->route('create_problem', ['book' => $this->book->id]);
    }


    public function render()
    {
        $myProblems = $this->problemService->filterProblems($this->search, $this->problems,
            $this->book->id);

        return view('livewire.problem.problems', [
            'myProblems' => $myProblems
        ]);
    }
}
