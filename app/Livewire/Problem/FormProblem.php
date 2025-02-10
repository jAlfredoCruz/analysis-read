<?php

namespace App\Livewire\Problem;

use App\Interfaces\Services\IProblemService;
use App\Models\Problem;
use Livewire\Component;
use App\Models\Book;
use App\Service\ProblemService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Validate;

class FormProblem extends Component
{
    public ?Problem $problem = null;
    public Book $book;
    private IProblemService $problemService;
    public Collection $problems;
    public bool $showLevels;

    #[Validate('required|regex:/^\d+(\.\d+)*\.$/')]
    public string $level = '';
    #[Validate('required')]
    public string $name = '';
    #[Validate('required')]
    public string $text = '';

    public function boot(
        ProblemService $problemService
    ){
        $this->problemService = $problemService;
    }

    public function mount(Book $book, ?Problem $problem)
    {
        $this->book = $book;
        $this->problems = $this->problemService->getProblemsByBook($book->id);
        if($problem && $problem->id){
            $this->problem = $problem;
            $this->level = $problem->level;
            $this->name = $problem->name;
            $this->text = $problem->text;
        }
    }

    public function save()
    {
        $message = '';

        $myProblem = new Problem();
        $myProblem->level = $this->level;
        $myProblem->name = $this->name;
        $myProblem->text = $this->text;

        if($this->problem && $this->problem->id){
            $this->problemService->updateProblem($this->problem->id, $myProblem);
            $message = "Problema actualizado";
        }else{
            $myProblem->book_id = $this->book->id;
            $this->problemService->saveProblem($myProblem);
            $message = "Problema creado";
        }

        return redirect()->route('problem', ['book' => $this->book->id])->with('message', $message);
    }

    public function openShowLevels()
    {
        $this->showLevels = true;
    }

    public function render()
    {
        return view('livewire.problem.form-problem');
    }
}
