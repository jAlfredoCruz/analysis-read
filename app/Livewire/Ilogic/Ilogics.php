<?php

namespace App\Livewire\Ilogic;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Book;
use App\Service\IlogicService;
use App\Interfaces\Services\IIlogicService;
use Livewire\Attributes\On;
use Laravel\Jetstream\InteractsWithBanner;

class Ilogics extends Component
{
    use WithPagination, InteractsWithBanner;

    public bool $showSuggestionModal;
    public Book $book;
    public string $search = '';

    private IIlogicService $IlogicService;

    public function boot(
        IlogicService $IlogicService
        )
    {
        $this->IlogicService = $IlogicService;
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
        $this->IlogicService->deleteIlogic($id);
        $this->banner('Comentario ilogico eliminado');
    }

    public function createIlogic()
    {
        return redirect()->route('create_ilogic', ['book' => $this->book->id]);
    }

    public function render()
    {
        $myIlogics = $this->IlogicService
        ->filterIlogics($this->search, $this->book->id, 5);

        return view('livewire.ilogic.ilogics', [
            'myIlogics'  => $myIlogics
        ]);
    }
}
