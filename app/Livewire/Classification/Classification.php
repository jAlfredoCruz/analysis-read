<?php

namespace App\Livewire\Classification;

use Livewire\Component;
use App\Enums\Type;
use App\Enums\Proposed;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Services\IClassificationService;
use App\Models\Book;
use App\Service\ClassificationService;
use Illuminate\Database\Eloquent\Collection;

class Classification extends Component
{
    public bool $typeModal;
    public bool $proposalModal;
    public bool $myCategoryModal;

    public array $types;
    public array $proposals;
    public Collection $myCategories;

    public string $type;
    public string $proposal ;
    public string $myCategory;

    public Book $book;
    private IClassificationService  $classificationService;

    public function boot(
        ClassificationService $classificationService
    )
    {
        $this->classificationService = $classificationService;
        $this->types = Type::cases();
        $this->proposals = Proposed::cases();
        $this->myCategories = $this->classificationService->getMyCategories(Auth::id());
    }

    public function mount(Book $book)
    {
        $this->book = $book;
        $this->type = $this->classificationService->getType($book->id);
        $this->proposal = $this->classificationService->getProposalCategory($book->id);
        $this->myCategory = $this->classificationService->getMyCategory($book->id);
    }
    public function openTypeModal()
    {
        $this->typeModal = true;
    }

    public function openProposalModal()
    {
        $this->proposalModal = true;
    }

    public function openMyCategoryModal()
    {
        $this->myCategoryModal = true;
    }

    public function saveType()
    {
        $this->classificationService->saveBookType($this->book->id, $this->type);
        $this->typeModal = false;
    }

    public function saveProposal()
    {
        $this->classificationService->saveBookProposalCategory($this->book->id, $this->proposal);
        $this->proposalModal = false;
    }

    public function saveMyCategory()
    {
        $this->classificationService->saveBookMyCategory($this->book->id, $this->myCategory);
        $this->myCategoryModal = false;

    }

    public function redirectToManagerCategories()
    {
        return redirect()->route('my_categories', ['book' => $this->book->id]);
    }

    public function render()
    {
        return view('livewire.classification.classification');
    }

}

