<?php

namespace App\Livewire\Argument;

use App\Interfaces\Services\IArgumentService;
use Livewire\Component;
use App\Models\Book;
use App\Service\ArgumentService;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Laravel\Jetstream\InteractsWithBanner;

class Arguments extends Component
{
    use WithPagination, InteractsWithBanner;

    public bool $showSuggestionModal;
    public Book $book;
    public string $search = '';

    private IArgumentService $argumentService;

    public function boot(
        ArgumentService $argumentService
    ){
        $this->argumentService = $argumentService;
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
        $this->argumentService->deleteArgument($id);
    }

    public function createArgument()
    {
        return redirect()->route('create_argument', ['book' => $this->book->id]);
    }

    public function render()
    {
        $myArguments = $this->argumentService
                    ->filterArguments($this->search, $this->book->id, 5);
        return view('livewire.argument.arguments', [
            'myArguments' => $myArguments
        ]);
    }
}
