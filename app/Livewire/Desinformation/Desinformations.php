<?php

namespace App\Livewire\Desinformation;

use App\Interfaces\Services\IDesinformationService;
use Livewire\Component;
use App\Models\Book;
use App\Service\DesinformationService;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Laravel\Jetstream\InteractsWithBanner;

class Desinformations extends Component
{
    use WithPagination, InteractsWithBanner;

    public bool $showSuggestionModal;
    public Book $book;
    public string $search = '';

    private IDesinformationService $desinformationService;

    public function boot(
        DesinformationService $desinformationService
    ){
        $this->desinformationService= $desinformationService;
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
        $this->desinformationService->deleteDesinformation($id);
        $this->banner('Desinformacion borrada');
    }

    public function createDesinformation()
    {
        return redirect()->route('create_desinformation', ['book' => $this->book->id]);
    }


    public function render()
    {
        $myDesinformations = $this->desinformationService
        ->filterDesinformations($this->search, $this->book->id, 5);

        return view('livewire.desinformation.desinformations', [
            'myDesinformations' => $myDesinformations
        ]);
    }
}
