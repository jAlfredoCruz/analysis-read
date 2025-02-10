<?php

namespace App\Livewire\Sentence;

use App\Interfaces\Services\ISentenceService;
use Livewire\Component;
use App\Models\Book;
use App\Service\SentenceService;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Laravel\Jetstream\InteractsWithBanner;

class Sentences extends Component
{
    use WithPagination, InteractsWithBanner;

    public bool $showSuggestionModal;
    public Book $book;
    public string $search = '';
    private ISentenceService $sentenceService;

    public function boot(
        SentenceService $sentenceService
    ){
        $this->sentenceService = $sentenceService;
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

    #[On('text-delete')]
    public function delete(int $id)
    {
        $this->sentenceService->deleteSentence($id);
        $this->banner('Proposicion eliminada');
    }

    public function createSentence()
    {
        return redirect()->route('create_sentence', ['book' => $this->book->id]);
    }

    public function render()
    {
        $mySentences = $this->sentenceService
                ->filterSentences($this->search, $this->book->id, 5);

        return view('livewire.sentence.sentences', [
            'mySentences' => $mySentences
        ]);
    }
}
