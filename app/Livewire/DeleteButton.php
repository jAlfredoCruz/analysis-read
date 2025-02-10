<?php

namespace App\Livewire;

use Livewire\Component;

class DeleteButton extends Component
{
    public bool $showDialog;

    public int $id;

    public function mount(int $id)
    {
        $this->id = $id;
    }

    public function delete()
    {
        $this->dispatch('text-delete', id: $this->id);
    }

    public function closeShowModal()
    {
        $this->showDialog = false;
    }

    public function deleteModal()
    {
        $this->showDialog = true;
    }

    public function render()
    {
        return view('livewire.delete-button');
    }
}
