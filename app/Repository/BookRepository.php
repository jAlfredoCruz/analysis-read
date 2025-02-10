<?php

namespace App\Repository;

use App\Interfaces\Repositories\IBookRepository;
use App\Interfaces\Repositories\IClassificationRepository;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class BookRepository implements IBookRepository{

    public function save(Book $book, int $userId): Book
    {
        $bookToSave = new Book();
        $bookToSave->title = $book->title;
        $bookToSave->isbn = $book->isbn;
        $bookToSave->user_id = $userId;
        $bookToSave->save();

        return $bookToSave;
    }

    public function findBooksByUserId(int $userId): Collection
    {
        $user = User::findOrFail($userId);

        return $user->books;
    }

    public function update(array $book, int $bookId): Book
    {
        $bookToUpdate = Book::findOrFail($bookId);
        $bookToUpdate->title = $book['title'];
        $bookToUpdate->isbn = $book['isbn'];
        $bookToUpdate->save();

        return $bookToUpdate;
    }

    public function delete(int $bookId): void
    {
        $bookToDelete = Book::findOrFail($bookId);
        $bookToDelete->delete();
    }

    public function findBookById(int $bookId): Book
    {
       return Book::findOrFail($bookId);
    }

    public function filterBooks(array $filters, int $userId): Collection
    {
        return Book::join('book_author', 'book_author.book_id', '=', 'books.id')
            ->join('authors', 'book_author.author_id', '=', 'authors.id')
            ->where('books.user_id',$userId)
            ->orWhere('title', 'like', '%'.$filters['title'].'%')
            ->orWhere('authors.name', 'like', '%'.$filters['author'].'%' )
            ->orWhere('type', $filters['type'])
            ->orWhere('my_own_category_id', $filters['my_own_category'])
            ->get();
    }
}
