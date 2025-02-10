<?php

namespace App\Livewire\Classification;

use Livewire\Component;
use App\Interfaces\Services\IClassificationService;
use App\Service\ClassificationService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CategoryTable extends Component
{
    public bool $showCreateModal;
    public bool $showUpdateModal;
    public string $newCategory;
    public string $categoryName = '';
    public int $categoryId = 0;
    public string $search = '';

    private IClassificationService $categoryService;

    public function boot(
        ClassificationService $categoryService
    )
    {
        $this->categoryService = $categoryService;
    }

    public function createCategory()
    {
        $this->categoryService->saveMyCategory(Auth::id(), $this->newCategory);
        $this->newCategory = '';
        $this->showCreateModal = false;
    }

    public function openCreateModal()
    {
        $this->showCreateModal = true;
    }

    public function deleteCategory(int $categoryId)
    {
        $this->categoryService->deleteMyCategory($categoryId);
    }

    public function editCategory(int $categoryId, string $categoryName)
    {
        $this->showUpdateModal = true;
        $this->categoryId = $categoryId;
        $this->categoryName = $categoryName;
    }

    public function updateCategory()
    {
        $this->categoryService->updateMyCategory($this->categoryId, $this->categoryName);
        $this->categoryId = 0;
        $this->categoryName = '';
        $this->showUpdateModal = false;
    }

    public function render()
    {
       $myCategories = ClassificationService::filterMyCategories(Auth::id(), $this->search);

        return view('livewire.classification.category-table', [
            'myCategories' => $myCategories
        ]);
    }
}
