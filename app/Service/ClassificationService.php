<?php

namespace App\Service;

use App\Interfaces\Repositories\IBookRepository;
use App\Interfaces\Repositories\IClassificationRepository;
use App\Interfaces\Repositories\IOwnCategoryRepository;
use App\Interfaces\Services\IClassificationService;
use App\Models\Book;
use App\Models\MyOwnCategory;
use Illuminate\Database\Eloquent\Collection;

class ClassificationService implements IClassificationService {

    public function __construct(
       private IClassificationRepository $classificationRepository,
       private IOwnCategoryRepository $categoryRepository
    )
    {}

    public function getType(int $bookId): string {
        $type = $this->classificationRepository->getTypeOfBook($bookId);
        if($type == ''){
            return 'Sin Categoria';
        }

        return $type;
    }

    public function getProposalCategory(int $bookId): string {
        $proposal = $this->classificationRepository->getProposalCategory($bookId);
        if($proposal == ''){
            return 'Sin Categoria';
        }

        return $proposal;
    }

    public function getMyCategory(int $bookId): string {
        $category = $this->classificationRepository->getMyOwnCategoryName($bookId);
        if($category == ''){
            return 'Sin Categoria';
        }
        return $category;
    }
    public function saveBookType(int $bookId, string $type): void {
        $this->classificationRepository->saveBookType($bookId, $type);
    }

    public function saveBookProposalCategory(int $bookId, string $proposal): void {
        $this->classificationRepository->saveBookProposalCategory($bookId, $proposal);
    }

    public function saveBookMyCategory(int $bookId, string $category): void {
        $this->classificationRepository->saveBookMyCategory($bookId, $category);
    }

    public function getMyCategories(int $userId): Collection
    {
        return $this->categoryRepository->findCategoriesByUserId($userId);
    }

    public function saveMyCategory(int $userId, string $category): void {
        $myCategory = new MyOwnCategory();
        $myCategory->name = $category;
        $myCategory->user_id = $userId;
        $this->categoryRepository->save($myCategory);
    }

    public function deleteMyCategory( int $categoryId): void {

        Book::where('my_own_category_id', $categoryId)->update(['my_own_category_id' => null]);
        $this->categoryRepository->delete($categoryId);

    }

    public function updateMyCategory( int $categoryId, string $newCategory): void {
        $this->categoryRepository->update($newCategory, $categoryId);
    }

    public static function filterMyCategories(int $userId, string $categoryName = ''): Collection {
        if($categoryName === '') {

            $categories = MyOwnCategory::where('user_id', $userId)->get();
            return $categories;

        }else{
            return MyOwnCategory::where('user_id', $userId)
            ->where('name', 'like', '%' . $categoryName . '%')
            ->get();
        }
    }
}
