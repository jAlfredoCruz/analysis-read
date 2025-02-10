<?php

namespace App\Interfaces\Services;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

interface IClassificationService {
    public function saveBookType(int $bookId, string $type): void;
    public function saveBookProposalCategory(int $bookId, string $proposal): void;
    public function saveBookMyCategory(int $bookId, string $myCategoryId): void;
    public function getType(int $bookId): string;
    public function getProposalCategory(int $bookId): string;
    public function getMyCategory(int $bookId): string;
    public function getMyCategories(int $userId): Collection;
    public function saveMyCategory(int $userId, string $categoryName): void;
    public function deleteMyCategory(int $categoryId): void;
    public function updateMyCategory(int $categoryId, string $categoryName): void;
    public static function filterMyCategories(int $userId, string $categoryName): Collection;
}
