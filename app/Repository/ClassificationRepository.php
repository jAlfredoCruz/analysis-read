<?php

namespace App\Repository;

use App\Interfaces\Repositories\IClassificationRepository;
use App\Models\Book;

class ClassificationRepository implements IClassificationRepository{

    private function findBookById(int $bookId): Book
    {
       return Book::findOrFail($bookId);
    }

    public function getTypeOfBook(int $bookId): string
    {
        $book = $this->findBookById($bookId);
        if(!$book->type){
            return '';
        }

        return $book->type;
    }

    public function getProposalCategory(int $bookId): string
    {
        $book = $this->findBookById($bookId);
        if(!$book->proposal){
            return '';
        }

        return $book->proposal;
    }

    public function getMyOwnCategoryName(int $bookId): string
    {
        $book = $this->findBookById($bookId);
        if(!$book->category){
            return '';
        }

        return $book->category->name;
    }

    public function getMyOwnCategoryId(int $bookId): int
    {
        $book = $this->findBookById($bookId);
        if(!$book->category){
            return 0;
        }

        return $book->category->id;
    }
    public function saveBookType(int $bookId, string $type): Book
    {
        $book = $this->findBookById($bookId);
        $book->type = $type;
        $book->save();

        return $book;
    }
    public function saveBookProposalCategory(int $bookId, string $proposal): Book
    {
        $book = $this->findBookById($bookId);
        $book->proposal = $proposal;
        $book->save();

        return $book;
    }
    public function saveBookMyCategory(int $bookId, int $myCategoryId): void
    {
        $book = $this->findBookById($bookId);
        $book->my_own_category_id = $myCategoryId;
        $book->save();
    }
}
