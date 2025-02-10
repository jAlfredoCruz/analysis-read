<?php

namespace App\Livewire\Dashboard;

use App\Interfaces\Services\IManagerService;
use Livewire\Component;
use App\Service\ManagerService;
use App\Enums\Proposed;
use App\Enums\Type;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Book\BookList;

class FilterModal extends Component
{
    public bool $show = false;
    public string $title = '';
    public string $author = '';
    public array $types;
    public array $proposals;
    public Collection $categories;
    private IManagerService $managerService;
    public string $type = 'All';
    public string $proposal = 'All';
    public int $category = -1;

    public function boot(
        ManagerService $managerService
    )
    {
        $this->managerService = $managerService;
        $this->types = Type::cases();
        $this->proposals = Proposed::cases();
        $this->categories = $this->managerService->getAllMyCategories(Auth::id());
    }

    public function open()
    {
        $this->show = true;
    }

    public function filter()
    {
        $filters = [
            'title' => $this->title,
            'author' => $this->author,
            'type' => $this->type,
            'proposal' => $this->proposal,
            'my_own_category' => $this->category
        ];

        $this->title = '';
        $this->author = '';
       $this->type = 'All';
        $this->proposal = 'All';
        $this->category = -1;

        $this->dispatch('filter-books', filters: $filters)
            ->to(BookList::class);

        $this->show = false;
    }

    public function render()
    {
        return view('livewire.dashboard.filter-modal');
    }
}
