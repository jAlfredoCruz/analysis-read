<?php

namespace App\Livewire\Incomplete;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Incomplete;
use App\Models\Book;
use App\Interfaces\Services\IIncompleteService;
use App\Service\IncompleteService;

class FormIncomplete extends Component
{
    #[Validate('required')]
    public string $text = '';

    public ?Incomplete $incomplete = null;
    public Book $book;

    private IIncompleteService $incompleteService;

    public function boot(
        IncompleteService $incompleteService
    ) {
        $this->incompleteService = $incompleteService;
    }

    public function mount(Book $book, ?Incomplete $incomplete)
    {
        $this->book = $book;
        if ($incomplete && $incomplete->id) {
            $this->incomplete = $incomplete;
            $this->text = $incomplete->text;
        }
    }

    public function save()
    {
        $myIncomplete = new Incomplete();
        $myIncomplete->text = $this->text;

        if ($this->incomplete && $this->incomplete->id) {
            $this->incompleteService->updateIncomplete($this->incomplete->id, $myIncomplete);
            $message = "incompletitud actualizada";
        } else {
            $myIncomplete->book_id = $this->book->id;
            $this->incompleteService->saveIncomplete($myIncomplete);
            $message = "incompletitud creada";
        }

        return redirect()->route('incomplete', ['book' => $this->book->id])->with('message', $message);
    }

    public function render()
    {
        return view('livewire.incomplete.form-incomplete');
    }
}
