<?php

namespace App\Livewire\Book;

use App\Models\Book;
use Livewire\Component;
use Livewire\Attributes\On;

class UpdateModal extends Component
{

    public bool $show = false;
    public Book $book;

    public function mount(Book $book)
    {
        $this->book = $book;
    }

    public function open()
    {
        $this->show = true;
    }

    #[On('close-modal')]
    public function close()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.book.update-modal');
    }
}
