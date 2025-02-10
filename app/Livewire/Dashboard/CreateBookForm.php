<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Service\ManagerService;
use App\Interfaces\Services\IManagerService;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\Validate;
use App\Livewire\Book\BookList;

class CreateBookForm extends Component
{

    use InteractsWithBanner;

    #[Validate('required')]
    public array $authors = [];

    public Collection $authorsOptions;
    private IManagerService $managerService;
    #[Validate('required')]
    public string $title = '';
    #[Validate('required')]
    public string $isbn = '';
    public $myBook;

    public function boot(
        ManagerService $managerService
       )
       {
          $this->managerService = $managerService;
          $this->authorsOptions = $this->managerService
                                        ->getAllAuthors(Auth::id());

       }

    public function mount(Book $book = null)
    {
        $this->title = $book->title ??  '';
        $this->isbn = $book->isbn ?? '';
        $this->authors = $book->authors->toArray() ?? [];
        $this->myBook = $book;
        array_push($this->authors, []);
    }

    public function addAuthor()
    {
        array_push($this->authors, []);
    }

    public function deleteAuthor($index)
    {
        $authorsCopy = $this->authors;
        unset($authorsCopy[$index]);
        $this->authors = array_values($authorsCopy);
    }

    public function modalClose()
    {
        $this->dispatch("close-modal");
    }

    public function save()
    {

        if($this->myBook->id == null){
            $bookToSave = new Book();
            $bookToSave->title = $this->title;
            $bookToSave->isbn = $this->isbn;
            $this->managerService->saveBook($bookToSave, $this->authors, Auth::id());
            unset($bookToSave);
        }else{
           $updatedBook = [
                'title' => $this->title,
                'isbn' => $this->isbn,
                'id' => $this->myBook->id
           ];
           $this->managerService->updateBook($updatedBook, $this->authors, Auth::id());
        }

        $this->title = '';
        $this->isbn = '';
        $this->authors = [];
        $this->dispatch("close-modal")->to(CreateBook::class);
        $this->dispatch("book-created")->to(BookList::class);
    }

    public function render()
    {
        return view('livewire.dashboard.create-book-form');
    }
}
