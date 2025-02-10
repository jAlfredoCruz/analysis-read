<?php

namespace App\Livewire\Terms;

use App\Models\Book;
use App\Models\Term;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Interfaces\Services\ITermService;
use App\Service\TermService;

class FormTerm extends Component
{
    #[Validate('required')]
    public string $name = '';

    #[Validate('required')]
    public string $definition = '';

    public ?Term $term = null;
    public Book $book;

    private ITermService $termService;

    public function boot(
        TermService $termService
    ){
        $this->termService = $termService;
    }


    public function mount(Book $book, ?Term $term)
    {
        $this->book = $book;
        if($term && $term->id){
            $this->term = $term;
            $this->name = $term->name;
            $this->definition = $term->definition;
        }
    }

    public function save()
    {
        $myTerm = new Term();
        $myTerm->name = $this->name;
        $myTerm->definition = $this->definition;

        if($this->term && $this->term->id){
            $this->termService->updateTerm($this->term->id, $myTerm);
            $message = "Termino actualizado";
        }else{
            $myTerm->book_id = $this->book->id;
            $this->termService->saveTerm($myTerm);
            $message = "Termino creado";
        }

        return redirect()->route('term', ['book' => $this->book->id])->with('message', $message);
    }

    public function render()
    {
        return view('livewire.terms.form-term');
    }
}
