<?php

namespace App\Livewire\Sentence;

use App\Models\Sentence;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Book;
use App\Interfaces\Services\ISentenceService;
use App\Service\SentenceService;

class FormSentence extends Component
{
    #[Validate('required')]
    public string $text = '';

    public ?Sentence $sentence = null;
    public Book $book;

    private ISentenceService $sentenceService;

    public function boot(
        SentenceService $sentenceService
    ){
        $this->sentenceService = $sentenceService;
    }

    public function mount(Book $book, ?Sentence $sentence)
    {
        $this->book = $book;
        if($sentence && $sentence->id){
            $this->sentence = $sentence;
            $this->text = $sentence->text;
        }
    }

    public function save()
    {
        $mySentence = new Sentence();
        $mySentence->text = $this->text;

        if($this->sentence && $this->sentence->id){
            $this->sentenceService->updateSentence($this->sentence->id, $mySentence);
            $message = "Oracion actualizada";
        }else{
            $mySentence->book_id = $this->book->id;
            $this->sentenceService->saveSentence($mySentence);
            $message = "Oracion creada";
        }

        return redirect()->route('sentence', ['book' => $this->book->id])->with('message', $message);
    }

    public function render()
    {
        return view('livewire.sentence.form-sentence');
    }
}
