<?php

namespace App\Livewire\Argument;

use App\Interfaces\Services\IArgumentService;
use App\Models\Argument;
use App\Models\Book;
use App\Service\ArgumentService;
use Livewire\Component;
use Livewire\Attributes\Validate;

class FormArgument extends Component
{
    #[Validate('required')]
    public string $text = '';

    public ?Argument $argument = null;
    public Book $book;

    private IArgumentService $argumentService;

    public function boot(
        ArgumentService $argumentService
    )
    {
        $this->argumentService = $argumentService;
    }

    public function mount(Book $book, ?Argument $argument)
    {
        $this->book = $book;
        if($argument && $argument->id){
            $this->argument = $argument;
            $this->text = $argument->text;
        }
    }

    public function save()
    {
        $myArgument = new Argument();
        $myArgument->text = $this->text;

        if($this->argument && $this->argument->id){
            $this->argumentService->updateArgument($this->argument->id, $myArgument);
            $message = "Argumento actualizada";
        }else{
            $myArgument->book_id = $this->book->id;
            $this->argumentService->saveArgument($myArgument);
            $message = "Argumento creada";
        }

        return redirect()->route('argument', ['book' => $this->book->id])->with('message', $message);
    }

    public function render()
    {
        return view('livewire.argument.form-argument');
    }
}
