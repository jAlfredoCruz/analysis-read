<?php

namespace App\Livewire\Analysis;

use App\Interfaces\Services\IPerfileService;
use Livewire\Component;
use App\Models\Perfil;
use App\Models\Book;
use App\Service\PerfilService;
use Illuminate\Support\Str;

class ReadAnalysis extends Component
{
    public Perfil $perfil;
    public Book $book;
    public string $text;
    public bool $denegateModal = false;
    public bool $deleteModal = false;

    private IPerfileService $perfilService;

    public function boot(
        PerfilService $perfilService
    )
    {
        $this->perfilService = $perfilService;
    }

    public function mount(Book $book, Perfil $perfil)
    {
        $this->book = $book;
        $this->perfil = $perfil;
        $this->text = Str::markdown($perfil->text);
    }

    public function edit()
    {
        return redirect()->route('update_perfil', ['perfil' => $this->perfil->id,
                    'book' => $this->book->id]);
    }

    public function modal()
    {  
        if(!$this->perfilService->hasSublevels($this->perfil))
        {
            $this->deleteModal = true;
        }else{         
            $this->denegateModal= true;
        }
    }

    public function delete()
    {
        $this->perfilService->deletePerfil($this->perfil->id);

        return redirect()->route('perfil', ['book' => $this->book->id]);
    }

    public function closeDeleteModal()
    {
        $this->deleteModal = false;
    }

    public function back(){
        return redirect()->route('perfil', ['book' => $this->book->id]);
    }

    public function closeDenegateModal()
    {
        $this->denegateModal= false;
    }

    public function render()
    {
        return view('livewire.analysis.read-analysis');
    }
}
