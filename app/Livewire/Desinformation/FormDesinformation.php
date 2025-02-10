<?php

namespace App\Livewire\Desinformation;

use App\Interfaces\Services\IDesinformationService;
use App\Models\Desinformation;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Book;
use App\Service\DesinformationService;


class FormDesinformation extends Component
{
    #[Validate('required')]
    public string $text = '';

    public ?Desinformation $desinformation = null;
    public Book $book;

    private IDesinformationService $desinformationService;

    public function boot(
        DesinformationService $desinformationService
    )
    {
        $this->desinformationService = $desinformationService;
    }

    public function mount(Book $book, ?Desinformation $desinformation)
    {
        $this->book = $book;
        if($desinformation && $desinformation->id){
            $this->desinformation = $desinformation;
            $this->text = $desinformation->text;
        }
    }

    public function save()
    {
        $myDesinformation = new Desinformation();
        $myDesinformation->text = $this->text;

        if($this->desinformation && $this->desinformation->id){
            $this->desinformationService->updateDesinformation($this->desinformation->id, $myDesinformation);
            $message = "Desinformacion actualizada";
        }else{
            $myDesinformation->book_id = $this->book->id;
            $this->desinformationService->saveDesinformation($myDesinformation);
            $message = "Desinformacion creada";
        }

        return redirect()->route('desinformation', ['book' => $this->book->id])->with('message', $message);
    }

    public function render()
    {
        return view('livewire.desinformation.form-desinformation');
    }
}
