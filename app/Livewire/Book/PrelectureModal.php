<?php

namespace App\Livewire\Book;

use Livewire\Component;

class PrelectureModal extends Component
{
    public bool $show = false;

    public function open()
    {
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.book.prelecture-modal');
    }
}
