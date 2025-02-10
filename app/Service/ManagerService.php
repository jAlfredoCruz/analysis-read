<?php

namespace App\Service;

use App\Interfaces\Services\IManagerService;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\Repositories\IAuthorRepository;
use App\Interfaces\Repositories\IBookRepository;
use App\Interfaces\Repositories\IOwnCategoryRepository;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Author;
use App\Models\User;
use App\Criteria\CompareBookCriteria;
use App\Criteria\AuthorBookCriteria;
use App\Criteria\CompareLikeCriteria;
use Baethon\LaravelCriteria\Collection\CriteriaCollection;


class ManagerService implements IManagerService
{
    public function __construct(
        private IAuthorRepository $authorRepository,
        private IBookRepository $bookRepository,
        private IOwnCategoryRepository $myCategoryRepository
    )
    {

    }

    public function getAllAuthors(int $userId): Collection
    {
        return $this->authorRepository->findAuthorsByUserId($userId);
    }

    public function saveBook(Book $newBook, array $authorsToSave, int $userId): void
    {
       $bookSaved = $this->bookRepository->save($newBook, $userId);

       if(!empty($authorsToSave)){
            foreach($authorsToSave as $authorToSave){
                $this->saveAuthorBook($authorToSave, $bookSaved, $userId);
            }
        }
    }

    public function updateBook(array $updateBook, array $authors, int $userId): void
    {
        $book = $this->bookRepository->update($updateBook, $updateBook['id']);
        foreach($authors as $author){
            if(isset($author['id'])){
                $this->authorRepository->update($author['name'], $author["id"]);
            }else{
                $this->saveAuthorBook($author, $book, $userId);
            }
        }
    }

    private function saveAuthorBook(array $authorToSave, Book $book, int $userId)
    {
        $author = null;

        if($this->authorRepository->existsByName($authorToSave['name'])){
            $author = $this->authorRepository->findAuthorByName($authorToSave['name']);
        }else{
            $newAuthor = new Author();
            $newAuthor->name = $authorToSave['name'];
            $author = $this->authorRepository->save($newAuthor, $userId);
        }

        DB::table('book_author')->insert([
            'book_id' => $book->id,
            'author_id' => $author->id,
        ]);
    }

    public function deleteBook(int $bookId): void
    {
        $book = Book::findorFail($bookId);

        $book->delete();

        $book->forceDelete();
    }

    public function deleteAuthorFromBook(int $bookId, int $authorId): void
    {
        DB::table('book_author')
            ->where('author_id', $authorId)
            ->where('book_id', $bookId)
            ->delete();
    }

    public function updateAuthorName(int $authorId, string $name): void
    {
        $this->authorRepository->update($name, $authorId);
    }

    public function deleteAuthor(int $authorId): void
    {
        $author = $this->authorRepository->findAuthorById($authorId);

        if($author->books->count() == 0){
            $this->authorRepository->delete($authorId);
        }
    }

    public function filterBooks(array $filters, int $userId, bool $t = false): Collection
    {

       $booksCriteria = [];

        if(!$t){
           return  Book::query()
            ->where('user_id', $userId)
            ->get();
        }

        if($filters['title'] != ''){
           array_push($booksCriteria, new CompareLikeCriteria('title', $filters['title']));
        }

        if($filters['author'] != ''){
            $authorsIds = $this->authorRepository->findAuthorsIdsLikeName($filters['author'], $userId);
            $booksIds = $this->getBookIdsFromAuthorsIds($authorsIds);
            array_push($booksCriteria, new AuthorBookCriteria($booksIds));
        }

        if($filters['proposal'] != 'All'){
            array_push($booksCriteria, new CompareBookCriteria('proposal', $filters['proposal']));
        }

        if($filters['type'] != 'All'){
           array_push($booksCriteria, new CompareBookCriteria('type', $filters['type']));
        }

        if($filters['my_own_category'] != -1){
         array_push($booksCriteria, new CompareBookCriteria('my_own_category_id', $filters['my_own_category']));
        }

        return Book::query()
                    ->where('user_id', $userId)
                    ->apply(CriteriaCollection::allof($booksCriteria))
                    ->get();
    }

    private function getBookIdsFromAuthorsIds(array $authorsIds): array
    {
        $booksIds = [];

        foreach($authorsIds as $authorId){

            $bookauthors = DB::table('book_author')
                    ->where('author_id', $authorId)
                    ->get();

            foreach($bookauthors as $bookauthor){
                if(!in_array($bookauthor->book_id, $booksIds)){
                    array_push($booksIds, $bookauthor->book_id);
                }
            }
        }

        return $booksIds;
    }

    public function getAuthorName(int $authorId): string
    {
        return $this->authorRepository->getAuthorName($authorId);
    }

    public function getAllMyCategories(int $userId): Collection
    {
        return $this->myCategoryRepository->findCategoriesByUserId($userId);
    }

    public function getAuthorsByBook(int $bookId)
    {
        return DB::table('authors')
            ->join('book_author', 'authors.id', '=', 'book_author.author_id')
            ->join('books', 'books.id', '=', 'book_author.book_id')
            ->where('books.id', '=', $bookId)
            ->select('authors.*')
            ->get();
    }


}
