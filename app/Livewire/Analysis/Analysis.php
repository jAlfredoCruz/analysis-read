<?php

namespace App\Livewire\Analysis;

use App\Interfaces\Services\IPerfileService;
use App\Models\Book;
use App\Service\PerfilService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Illuminate\Support\Str;

class Analysis extends Component
{
    public bool $showSuggestionModal;
    public bool $noDeleteModal;
    public bool $deleteModal;
    public string $search = '';
    public Book $book;
    public Collection $perfils;
    public bool $readPerfilModal;
    public string $perfilText;
    public string $perfilName;
    public int $perfilId;

    private IPerfileService $perfilService;

    public function boot(
        PerfilService $perfilService
    ){
        $this->perfilService = $perfilService;
    }

    public function mount(Book $book)
    {
        $this->book = $book;
       $this->perfils = $this->perfilService->getPerfilsByBook($book->id);
    }

    public function openSuggestionModal()
    {
        $this->showSuggestionModal = true;
    }

    public function closeSuggestionModal()
    {
        $this->showSuggestionModal = false;
    }

    public function createProfile()
    {
        return redirect()->route('create_perfil', ['book' => $this->book->id]);
    }

    public function render()
    {
        $myPerfils = $this->perfilService->filterPerfils($this->search,
                        $this->perfils, $this->book->id);

        return view('livewire.analysis.analysis', [
            'myPerfils' => $myPerfils
        ]);
    }
}
