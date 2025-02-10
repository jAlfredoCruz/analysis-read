<?php

namespace App\Livewire\Dashboard;

use App\Interfaces\Services\IManagerService;
use App\Service\ManagerService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;


class CreateBook extends Component
{
    public bool $show = false;
    public Collection $authors;
    private IManagerService $managerService;

    public function boot(
        ManagerService $managerService
    )
    {
        $this->managerService = $managerService;
        $this->authors = $this->managerService->getAllAuthors(Auth::id());
    }

    public function open()
    {
        $this->show = true;
    }

    #[On('close-modal')]
    public function close()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.dashboard.create-book');
    }
}
