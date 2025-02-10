<?php

namespace App\Interfaces\Repositories;

use App\Models\Book;

interface IClassificationRepository {
    public function getTypeOfBook(int $bookId): string;
    public function getProposalCategory(int $bookId): string;
    public function getMyOwnCategoryName(int $bookId): string;
    public function getMyOwnCategoryId(int $bookId): int;
    public function saveBookType(int $bookId, string $type): Book;
    public function saveBookProposalCategory(int $bookId, string $proposal): Book;
    public function saveBookMyCategory(int $bookId, int $myCategoryId): void;
}
