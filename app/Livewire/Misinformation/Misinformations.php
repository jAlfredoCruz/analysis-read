<?php

namespace App\Livewire\Misinformation;

use App\Interfaces\Services\IMisinformationService;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Book;
use App\Service\MisinformationService;
use Livewire\Attributes\On;
use Laravel\Jetstream\InteractsWithBanner;

class Misinformations extends Component
{
    use WithPagination, InteractsWithBanner;

    public bool $showSuggestionModal;
    public Book $book;
    public string $search = '';

    private IMisinformationService $misinformationService;

    public function boot(
        MisinformationService $misinformationService
        )
    {
        $this->misinformationService = $misinformationService;
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
        $this->misinformationService->deleteMisinformation($id);
        $this->banner('Mal informacion eliminado');
    }

    public function createMisinformation()
    {
        return redirect()->route('create_misinformation', ['book' => $this->book->id]);
    }


    public function render()
    {
        $myMisinformations = $this->misinformationService
            ->filterMisinformations($this->search, $this->book->id, 5);

        return view('livewire.misinformation.misinformations', [
            'myMisinformations' => $myMisinformations
        ]);
    }
}
