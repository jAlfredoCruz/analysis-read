<?php

namespace App\Livewire\Ilogic;

use App\Models\Ilogic;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Interfaces\Services\IIlogicService;
use App\Service\IlogicService;
use App\Models\Book;

class FormIlogic extends Component
{
    #[Validate('required')]
    public string $text = '';

    public ?Ilogic $ilogic = null;
    public Book $book;

    private IIlogicService $ilogicService;

    public function boot(
        IlogicService $ilogicService
    ) {
        $this->ilogicService = $ilogicService;
    }

    public function mount(Book $book, ?Ilogic $ilogic)
    {
        $this->book = $book;
        if ($ilogic && $ilogic->id) {
            $this->ilogic = $ilogic;
            $this->text = $ilogic->text;
        }
    }

    public function save()
    {
        $myIlogic = new Ilogic();
        $myIlogic->text = $this->text;

        if ($this->ilogic && $this->ilogic->id) {
            $this->ilogicService->updateIlogic($this->ilogic->id, $myIlogic);
            $message = "creada";
        } else {
            $myIlogic->book_id = $this->book->id;
            $this->ilogicService->saveIlogic($myIlogic);
            $message = "actualizada";
        }

        return redirect()->route('ilogic', ['book' => $this->book->id])->with('message', $message);
    }

    public function render()
    {
        return view('livewire.ilogic.form-ilogic');
    }
}
