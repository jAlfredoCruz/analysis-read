<?php

namespace App\Interfaces\Repositories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

interface IBookRepository {
    public function save(Book $book, int $userId): Book;
    public function findBooksByUserId(int $userId): Collection;
    public function update(array $book, int $userId): Book;
    public function delete(int $bookid): void;
    public function findBookById(int $bookId): Book;
    public function filterBooks(array $filters, int $userid): Collection;
}
