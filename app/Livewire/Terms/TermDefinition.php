<?php

namespace App\Livewire\Terms;

use App\Interfaces\Services\ITermService;
use App\Models\Book;
use App\Service\TermService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Laravel\Jetstream\InteractsWithBanner;

class TermDefinition extends Component
{

    use WithPagination, InteractsWithBanner;

    public bool $showSuggestionModal;
    private ITermService $termService;
    public Book $book;
    public string $search = '';

    public function boot(
        TermService $termService
    )
    {
        $this->termService = $termService;
    }

    public function mount(
        Book $book
    )
    {
        $this->book = $book;
    }

    public function openSuggestionModal()
    {
        $this->showSuggestionModal = true;
    }


    public function closeSuggestionModal()
    {
        $this->showSuggestionModal = false;
    }

    public function createTerm()
    {
        return redirect()->route('term_create', ['book' => $this->book->id]);
    }

    #[On('text-delete')]
    public function delete(int $id)
    {
        $this->termService->deleteTerm($id);
        $this->banner('Termino eliminado');
    }

    public function render()
    {
        $myTerms = $this->termService->filterTerms($this->search, $this->book->id, 5);

        return view('livewire.terms.term-definition', [
            'myTerms' => $myTerms
        ]);
    }
}
