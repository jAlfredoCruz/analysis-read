<?php

namespace App\Livewire\Incomplete;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Book;
use App\Interfaces\Services\IIncompleteService;
use App\Service\IncompleteService;
use Laravel\Jetstream\InteractsWithBanner;

class Incompletes extends Component
{

    use WithPagination, InteractsWithBanner;

    public bool $showSuggestionModal;
    public Book $book;
    public string $search = '';

    private IIncompleteService $incompleteService;

    public function boot(
        IncompleteService $incompleteService
        )
    {
        $this->incompleteService = $incompleteService;
    }

    public function mount(Book $book)
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

    #[On('text-delete')]
    public function delete(int $id)
    {
        $this->incompleteService->deleteIncomplete($id);
        $this->banner('Comentario incompleto eliminado eliminado');
    }

    public function createIncomplete()
    {
        return redirect()->route('create_incomplete', ['book' => $this->book->id]);
    }

    public function render()
    {
        $myIncompletes = $this->incompleteService
        ->filterIncompletes($this->search, $this->book->id, 5);

        return view('livewire.incomplete.incompletes', [
            'myIncompletes' =>$myIncompletes
        ]);
    }
}
