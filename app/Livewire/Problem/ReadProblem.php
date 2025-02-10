<?php

namespace App\Livewire\Problem;

use App\Interfaces\Services\IProblemService;
use App\Models\Problem;
use Livewire\Component;
use App\Models\Book;
use App\Service\ProblemService;
use Illuminate\Support\Str;

class ReadProblem extends Component
{
    public Book $book;
    public Problem $problem;
    public string $problemText;
    public string $answerText;
    public bool $denegateModal;
    public bool $deleteModal;
    public bool $answer;

    private IProblemService $problemService;

    public function boot(
        ProblemService $problemService
    )
    {
        $this->problemService = $problemService;
    }

    public function mount(Problem $problem, Book $book, bool $answer = false )
    {
        $this->book = $book;
        $this->problem = $problem;
        $this->problemText = Str::markdown($problem->text);
        $this->answerText = $problem->solution == null ? '' : Str::markdown($problem->solution);
        $this->answer = $answer;
    }

    public function edit()
    {
        return redirect()->route('update_problem', ['problem' => $this->problem->id,
                    'book' => $this->book->id]);
    }

    public function editAnswer()
    {
        return redirect()->route('update_answer', ['problem' => $this->problem->id,
        'book' => $this->book->id]);
    }

    public function modal()
    {
        if(!$this->problemService->hasSubordinate($this->problem))
        {
            $this->deleteModal = true;
        }else{
            $this->denegateModal= true;
        }
    }

    public function delete()
    {
        $this->problemService->deleteProblem($this->problem->id);

        return redirect()->route('problem', ['book' => $this->book->id]);
    }

    public function closeDeleteModal()
    {
        $this->deleteModal = false;
    }

    public function closeDenegateModal()
    {
        $this->denegateModal= false;
    }

    public function render()
    {
        return view('livewire.problem.read-problem');
    }
}
