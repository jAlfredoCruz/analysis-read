<?php

namespace App\Livewire\Analysis;

use App\Interfaces\Services\IPerfileService;
use App\Models\Book;
use App\Models\Perfil;
use App\Service\PerfilService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Attributes\Validate;

class FormAnalysis extends Component
{
    public bool $showLevels;

    #[Validate('required|regex:/^\d+(\.\d+)*\.$/')]
    public string $level = '';
    #[Validate('required')]
    public string $name = '';
    #[Validate('required')]
    public string $text = '';
    
    public Collection $perfils;

    public Book $book;
    public ?Perfil $perfil = null;
    private IPerfileService $perfilService;

    public function boot(
        PerfilService $perfilService
    )
    {
        $this->perfilService = $perfilService;
    }


    public function mount(Book $book, ?Perfil $perfil )
    {
        $this->book = $book;
        $this->perfils = $this->perfilService->getPerfilsByBook($book->id);
        if($perfil && $perfil->id){
            $this->perfil = $perfil;
            $this->level = $perfil->level;
            $this->name = $perfil->name;
            $this->text = $perfil->text;
        }

    }

    public function save()
    {
        $message = '';

        $myPerfil = new Perfil();
        $myPerfil->level = $this->level;
        $myPerfil->name = $this->name;
        $myPerfil->text = $this->text;

        if($this->perfil && $this->perfil->id){
            $this->perfilService->updatePerfil($this->perfil->id, $myPerfil);
            $message = "Perfil actualizado";
        }else{
            $myPerfil->book_id = $this->book->id;
            $this->perfilService->savePerfil($myPerfil);
            $message = "Perfil creado";
        }

        return redirect()->route('perfil', ['book' => $this->book->id])->with('message', $message);
    }

    public function openShowLevels()
    {
        $this->showLevels = true;
    }

    public function render()
    {
        return view('livewire.analysis.form-analysis');
    }
}
