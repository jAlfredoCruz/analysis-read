<?php

namespace App\Livewire;

use Livewire\Component;

class RedirectButton extends Component
{
    public string $route;

    public function mount(string $route)
    {
        $this->route = $route;
    }

    public function back()
    {
        return redirect($this->route);
    }

    public function render()
    {
        return <<<'HTML'
        <div>
            <x-primary-button wire:click='back'>
                Regresar
            </x-primary-button>
        </div>
        HTML;
    }
}
