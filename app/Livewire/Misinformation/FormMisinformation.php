<?php

namespace App\Livewire\Misinformation;

use Livewire\Component;
use App\Models\Book;
use App\Models\Misinformation;
use App\Interfaces\Services\IMisinformationService;
use App\Service\MisinformationService;
use Livewire\Attributes\Validate;

class FormMisinformation extends Component
{
    #[Validate('required')]
    public string $text = '';

    public ?Misinformation $misinformation = null;
    public Book $book;

    private IMisinformationService $misinformationService;

    public function boot(
        MisinformationService $argumentService
    )
    {
        $this->misinformationService = $argumentService;
    }

    public function mount(Book $book, ?Misinformation $misinformation)
    {
        $this->book = $book;
        if($misinformation && $misinformation->id){
            $this->misinformation = $misinformation;
            $this->text = $misinformation->text;
        }
    }

    public function save()
    {
        $myMisinformation = new Misinformation();
        $myMisinformation->text = $this->text;

        if($this->misinformation && $this->misinformation->id){
            $this->misinformationService->updateMisinformation($this->misinformation->id, $myMisinformation);
            $message = "Misinformacion actualizada";
        }else{
            $myMisinformation->book_id = $this->book->id;
            $this->misinformationService->saveMisinformation($myMisinformation);
            $message = "Misinformacion creada";
        }

        return redirect()->route('misinformation', ['book' => $this->book->id])->with('message', $message);
    }

    public function render()
    {
        return view('livewire.misinformation.form-misinformation');
    }
}
