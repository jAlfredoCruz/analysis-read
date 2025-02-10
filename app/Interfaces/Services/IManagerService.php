<?php

namespace App\Interfaces\Services;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;


interface IManagerService
{
    public function getAllAuthors(int $userId): Collection;
    public function getAuthorName(int $authorId): string;
    public function getAllMyCategories(int $userId): Collection;
    public function saveBook(Book $newBook, array $authors, int $userId): void;
    public function updateBook(array $updateBook, array $authors, int $userId): void;
    public function deleteBook(int $book): void;
    public function deleteAuthorFromBook(int $bookId, int $authorId): void;
    public function updateAuthorName(int $auhtorId, string $name): void;
    public function deleteAuthor(int $authorId): void;
    public function filterBooks(array $filters, int $userId): Collection;
}
