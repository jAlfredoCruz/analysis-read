<?php

namespace App\Livewire\Dashboard;

use App\Interfaces\Services\IManagerService;
use Livewire\Component;
use App\Service\ManagerService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use App\Models\Author;
use Illuminate\Support\Str;

class ManagerAuthor extends Component
{
    public bool $show = false;
    public bool $isUpdated = false;
    public int $authorId = -1;
    public string $name = "";
    public Collection $authors;
    private IManagerService $managerService;
    public Collection $authorsFilters;
    public string $search = '';

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

    public function openIsUpdated(int $authorId)
    {
        $this->authorId = -1;
        $this->name = '';
        $this->isUpdated = true;
        $this->authorId = $authorId;
        $this->name = $this->managerService->getAuthorName($authorId);
    }

    public function closeIsUpdated()
    {
        $this->isUpdated = false;
        $this->authorId = -1;
        $this->name = '';
    }

    public function updateAuthor()
    {
        $this->managerService->updateAuthorName($this->authorId, $this->name);
        $this->authors = $this->managerService->getAllAuthors(Auth::id());
        $this->authorId = -1;
        $this->name = '';
        $this->isUpdated = false;
    }

    public function filters()
    {
        if($this->search == '')
        {
           return $this->authors;
        }else{
            return $this->authors->filter(function(Author $author){
                return Str::contains(strtolower($author->name),strtolower($this->search));
            });
        }
    }

    public function render()
    {
        $authorsFiltered = $this->filters();

        return view('livewire.dashboard.manager-author', [
            'authorsFiltered' => $authorsFiltered
        ]);
    }
}
