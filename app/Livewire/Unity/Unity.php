<?php

namespace App\Livewire\Unity;

use App\Interfaces\Services\ISynthesisService;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Service\SynthesisService;
use App\Models\Book;

class Unity extends Component
{
    public bool $showSuggestionModaL;
    public bool $read = true;
    public string $text = '';
    public string $synthesis = '';
    public Book $book;
    public $synthesisModel;
    public int $synthesisId;

    private ISynthesisService $synthesisService;

    public function boot(
        SynthesisService $synthesisService
    ) {
        $this->synthesisService = $synthesisService;
    }

    public function mount(Book $book)
    {
        $this->book = $book;
        $this->setSynthesis();
    }

    public function saveSynthesis()
    {
        if($this->synthesisId != 0){
            $this->synthesisService->updateSynthesis($this->synthesisId, $this->synthesis);
        }else{
            $this->synthesisService->saveSynthesis($this->book->id, $this->synthesis);
        }
        $this->setSynthesis();
        $this->read = true;

    }

    public function editSynthesis()
    {
        $this->read = false;
    }

    public function readSynthesis()
    {
        $this->read = true;
    }


    public function openSuggestionModal()
    {
        $this->showSuggestionModaL = true;
    }

    public function closeSuggestionModal()
    {
        $this->showSuggestionModaL = false;
    }

    private function setSynthesis()
    {
        $this->synthesisModel =  $this->synthesisService->getSynthesisByBookId($this->book->id);
        $this->synthesis = $this->synthesisModel->text ?? '';
        $this->synthesisId =  $this->synthesisModel->id ?? 0;
        $this->text = Str::markdown($this->synthesis);
    }

    public function render()
    {
        return view('livewire.unity.unity');
    }
}
