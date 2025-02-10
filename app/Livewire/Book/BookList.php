<?php

namespace App\Livewire\Book;

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\Services\IManagerService;
use Illuminate\Support\Facades\Auth;
use App\Service\ManagerService;
use Livewire\Attributes\On;
use Laravel\Jetstream\InteractsWithBanner;
use App\Livewire\Dashboard\CreateBook;

class BookList extends Component
{
    use InteractsWithBanner;

    public Collection $myBooks;
    private IManagerService $managerService;
    private array $initFilters = [
        'title' => '',
        'author' => '',
        'proposal' => 'All',
        'type' => 'All',
        'my_own_category' => -1
    ];

    private $filters = [];

    public function boot(
        ManagerService $managerService
    )
    {
        $this->managerService = $managerService;
        $this->myBooks = $this->managerService->filterBooks($this->initFilters, Auth::id());
    }
    #[On("book-created")]
    public function created()
    {
        $this->dispatch("close-modal")->to(CreateBook::class);
        $this->myBooks = $this->managerService->filterBooks($this->initFilters, Auth::id());
    }

    #[On('filter-books')]
    public function filter($filters)
    {
        $this->filters = $filters;
        if($this->filters['title'] == $this->initFilters['title'] &&
            $this->filters['author'] == $this->initFilters['author'] &&
            $this->filters['proposal'] == $this->initFilters['proposal'] &&
            $this->filters['type'] == $this->initFilters['type'] &&
            $this->filters['my_own_category'] == $this->initFilters['my_own_category'])
        {
            $this->myBooks = $this->managerService->filterBooks($this->filters, Auth::id());
        }else{
            $this->myBooks = $this->managerService->filterBooks($this->filters, Auth::id(),true);
        }
    }

    #[On('delete-book')]
    public function delete($id)
    {
        $this->managerService->deleteBook($id);
        $this->myBooks = $this->managerService->filterBooks($this->initFilters, Auth::id());
    }

    public function render()
    {
        $books = $this->myBooks;
        return view('livewire.book.book-list', [
            'books' => $books
        ]);
    }
}
