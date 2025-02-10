<?php

namespace App\Livewire\Book;

use App\Models\Book;
use Livewire\Component;
use App\Models\Author;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades;
use App\Service\ManagerService;
use App\Livewire\Book\BookList;

class BookCard extends Component
{
    public bool $deleteModal = false;
    public Book $book;
    public Collection $authors;

    private ManagerService $managerService;

    public function boot(
        ManagerService $ms
    )
    {
        $this->managerService = $ms;
    }

    public function mount(Book $book)
    {
        $this->book = $book;
        $this->authors = $this->managerService->getAuthorsByBook($book->id);
    }

    public function openDelete()
    {
        $this->deleteModal = true;
    }

    public function delete()
    {
        $this->deleteModal = false;
        $this->dispatch('delete-book', id: $this->book->id)->to(BookList::class);
    }

    public function render()
    {
        return view('livewire.book.book-card');
    }
}
