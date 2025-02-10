<?php

namespace App\Livewire\Problem;

use App\Interfaces\Services\IProblemService;
use App\Models\Book;
use App\Models\Problem;
use App\Service\ProblemService;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class FormAnswer extends Component
{
    public Problem $problem;
    public Book $book;
    public string $problemText;
    private IProblemService $problemService;

    #[Validate('required')]
    public string $text ='';

    public function boot(
        ProblemService $problemService
    )
    {
        $this->problemService = $problemService;
    }

    public function mount(Problem $problem, Book $book)
    {
        $this->book = $book;
        $this->problem = $problem;
        $this->problemText = Str::markdown($problem->text);
        $this->text = $problem->solution == null ? '' : $problem->solution;
    }

    public function save()
    {
        $this->problemService->saveSolution($this->problem->id,
            $this->text);

        return redirect()->route('read_answer', ['book' => $this->book->id, 'problem' => $this->problem->id])->with('updated', 'Solucion guardada');
    }

    public function render()
    {
        return view('livewire.problem.form-answer');
    }
}
