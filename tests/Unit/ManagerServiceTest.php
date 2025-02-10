<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Service\ManagerService;
use App\Models\User;
use App\Models\Book;
use App\Models\Author;
use App\Models\MyOwnCategory;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\OwnCategoryRepository;
use Illuminate\Support\Facades\DB;
use App\Enums\Proposed;
use App\Enums\Type;

class ManagerServiceTest extends TestCase
{

    use RefreshDatabase;

    public function test_save_a_book_with_a_new_author()
    {
        $user = User::factory()
        ->create();

        $newBook = Book::factory()->make();

        $newAuthors = [
            1 => ['name' => 'Mortimer J. Adler'],
            2 => ['name' => 'Charles Van Doren']
        ];

       $managerService = $this->setupManagerService();

        $managerService->saveBook($newBook, $newAuthors, $user->id);

        $newBook = Book::first();

        $this->assertDatabaseHas('books', [
            'title' => $newBook->title,
            'isbn' => $newBook->isbn,
        ]);

        $this->assertDatabaseHas('authors', [
            'name' => 'Mortimer J. Adler',
        ]);

        $this->assertDatabaseHas('authors', [
            'name' => 'Charles Van Doren',
        ]);

        $this->assertDatabaseHas('book_author', [
            'book_id' => $newBook->id,
            'author_id' => 1,
        ]);

        $this->assertDatabaseHas('book_author', [
            'book_id' => $newBook->id,
            'author_id' => 2,
        ]);

        $bookUser = $user->books->first();
        $book = Book::find($bookUser->id);
        $this->assertEquals(2, count($book->authors));
    }

    public function test_save_a_book_with_a_saved_author()
    {
        $user = User::factory()
            ->has(Author::factory()->count(2))
            ->create();

        $author1 = $user->authors()->first();

        $newBook = Book::factory()->make();

        $newAuthors = [
            1 => ['name' => 'Mortimer J. Adler'],
            2 => ['name' => $author1->name ]
        ];

        $managerService = $this->setupManagerService();

        $managerService->saveBook($newBook, $newAuthors, $user->id);

         $newBook = Book::first();

         $author2 = Author::where('name', $newAuthors[1])->first();

        $this->assertDatabaseHas('books', [
            'title' => $newBook->title,
            'isbn' => $newBook->isbn,
        ]);

        $this->assertDatabaseHas('book_author', [
            'book_id' => $newBook->id,
            'author_id' => $author2->id,
        ]);

        $this->assertDatabaseHas('book_author', [
            'book_id' => $newBook->id,
            'author_id' => $author1->id,
        ]);

        $bookUser = $user->books->first();
        $book = Book::find($bookUser->id);
        $this->assertEquals(2, count($book->authors));
    }

    public function test_save_a_book_without_author()
    {
        $user = User::factory()
            ->create();

        $newBook = Book::factory()->make();

        $newAuthors = [];

        $managerService = $this->setupManagerService();

        $managerService->saveBook($newBook, $newAuthors, $user->id);

        $newBook = Book::first();

        $this->assertDatabaseHas('books', [
            'title' => $newBook->title,
            'isbn' => $newBook->isbn,
        ]);

       $this->assertEquals(0, count($newBook->authors));
    }

    public function test_update_a_book_with_the_same_authors()
    {
       $user = User::factory()
        ->has(Author::factory()->count(2))
        ->create();

        $authors = $user->authors();
        $book = Book::factory()->create(["user_id" => $user->id]);

        $newAuthors = collect([]);
        foreach($authors as $author)
        {
            DB::table('book_author')->insert([
                'book_id' => $book->id,
                'author_id' => $author->id,
            ]);

            $newAuthors->push([
                'id' => $author->id,
                'name' => $author->name
            ]);
        }

        $managerService = $this->setupManagerService();

        $updateBook = [
            'title' => 'New title',
            'isbn' => '1234567890',
            'id' => $book->id
        ];

        $managerService->updateBook($updateBook, $newAuthors->toArray(), $user->id);

        $updatedBook = Book::find($book->id);

        $this->assertEquals('New title', $updatedBook->title);
        $this->assertEquals('1234567890', $updatedBook->isbn);
    }

    public function test_update_a_book_with_new_authors()
    {
        $user = User::factory()
                ->create();

        $book = Book::factory()
                    ->for($user)
                    ->has(Author::factory()
                        ->for($user)
                        ->count(2))
                    ->create();

        $newAuthor = Author::factory()
                        ->for($user)
                        ->create();

        $newAuthors = collect([]);
        foreach($book->authors as $author){
            $newAuthors->push([
                'id' => $author->id,
                'name' => $author->name
            ]);
        }

        $newAuthors->push([
            'name' => 'Mortimer J. AdlerU'
        ]);

        $newAuthors->push([
            'name' => $newAuthor->name
        ]);

        $managerService = $this->setupManagerService();

        $updateBook = [
            'title' => 'New title',
            'isbn' => '1234567890',
            'id' => $book->id
        ];

        $managerService->updateBook($updateBook, $newAuthors->toArray(), $user->id);

        $updatedBook = Book::find($book->id);

       $this->assertDatabaseHas('authors', [
            'name' => 'Mortimer J. AdlerU'
        ]);

        $this->assertDatabaseHas('book_author', [
            'book_id' => $book->id,
            'author_id' => $newAuthor->id,
        ]);

        $this->assertEquals('New title', $updatedBook->title);
        $this->assertEquals('1234567890', $updatedBook->isbn);
        $this->assertEquals(4, $updatedBook->authors()->count());
    }

    public function test_delete_a_book()
    {
        $user = User::factory()
        ->create();

        $book = Book::factory()
            ->for($user)
            ->has(Author::factory()
                ->for($user))
            ->create();

        $author = $book->authors()->first();

        $managerService = $this->setupManagerService();

        $managerService->deleteBook($book->id);

        $this->assertModelMissing($book);

        $this->assertDatabaseMissing('book_author', [
           'author_id' => $author->id,
           'book_id' => $book->id
        ]);
    }

    public function test_delete_an_author_from_a_book()
    {
        $user = User::factory()
        ->create();

        $book = Book::factory()
            ->for($user)
            ->has(Author::factory()
                ->for($user)
                ->count(2))
            ->create();

        $author = $book->authors()->first();

        $managerService = $this->setupManagerService();

        $managerService->deleteAuthorFromBook($book->id, $author->id);

        $updatedBook = Book::find($book->id);

        $this->assertEquals(1, $updatedBook->authors()->count());

        $this->assertDatabaseMissing('book_author', [
            'author_id' => $author->id,
            'book_id' => $updatedBook->id
         ]);

    }

    public function test_update_author_name()
    {
        $user = User::factory()
        ->create();

        $author = Author::factory()
            ->for($user)
            ->create();

        $managerService = $this->setupManagerService();

        $managerService->updateAuthorName($author->id, 'New Author Name');

        $updatedAuthor = Author::find($author->id);

        $this->assertEquals('New Author Name', $updatedAuthor->name);
    }

    public function test_delete_an_author()
    {
        $user = User::factory()
        ->create();

        $author = Author::factory()
            ->for($user)
            ->create();

        $book = Book::factory()
                    ->for($user)
                    ->has(Author::factory()->count(2))
                    ->create();

        $author2 = $book->authors()->first();

        $managerService = $this->setupManagerService();

        $managerService->deleteAuthor($author->id);

        $this->assertModelMissing($author);

        $managerService->deleteAuthor($author2->id);

        $bookUpdated = Book::find($book->id);

        $this->assertEquals(2, $bookUpdated->authors()->count());

        $this->assertDatabaseHas('authors', [
            'id' => $author2->id,
            'name' => $author2->name,
        ]);
    }

    public function test_filter_books_without_filtering()
    {
        $user = User::factory()
                ->create();

        $myCategory = MyOwnCategory::factory()->create();

        $book1 = Book::factory()
                    ->for($user)
                    ->has(Author::factory()->count(2))
                    ->create([
                        'type' => Type::PRACTICAL->toString(),
                        'proposal' => Proposed::PRACTICAL->toString(),
                        'my_own_category_id' => $myCategory->id
                    ]);

        $book2 = Book::factory()
            ->for($user)
            ->has(Author::factory()->count(1))
            ->create([
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

        $book3 = Book::factory()
            ->for($user)
            ->has(Author::factory()->count(2))
            ->create([
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

        $authorNameFilter = '';
        $bookTitleFilter = '';
        $proposalFilter = 'All';
        $typeFilter = 'All';
        $myOwnCategoryFilter = -1;

        $managerService = $this->setupManagerService();

        $filters = [
            'author' => $authorNameFilter,
            'title' => $bookTitleFilter,
            'proposal' => $proposalFilter,
            'type' => $typeFilter,
            'my_own_category' => $myOwnCategoryFilter
        ];

        $filteredBook = $managerService->filterBooks($filters, $user->id);
        $this->assertEquals(3, $filteredBook->count());
    }

    public function test_filter_books_with_title()
    {
        $user = User::factory()
        ->create();

        $author= Author::factory()
                ->create();

        $myCategory = MyOwnCategory::factory()->create();

        $book1 = Book::factory()
            ->for($user)
            ->create([
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

        DB::table('book_author')->insert([
            'book_id' => $book1->id,
            'author_id' => $author->id
        ]);

        $book2 = Book::factory()
            ->for($user)
            ->has(Author::factory()->count(1))
            ->create([
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

        $book3 = Book::factory()
            ->for($user)
            ->has(Author::factory()->count(2))
            ->create([
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

            $authorNameFilter = '';
            $bookTitleFilter = $book1->title ;
            $proposalFilter = 'All';
            $typeFilter = 'All';
            $myOwnCategoryFilter = -1;

            $managerService = $this->setupManagerService();

            $filters = [
                'author' => $authorNameFilter,
                'title' => $bookTitleFilter,
                'proposal' => $proposalFilter,
                'type' => $typeFilter,
                'my_own_category' => $myOwnCategoryFilter
            ];

            $filteredBook = $managerService->filterBooks($filters, $user->id);

            $this->assertEquals(1, $filteredBook->count());
    }

    public function test_filter_books_with_author()
    {
        $user = User::factory()
        ->create();

        $author= Author::factory()
                ->for($user)
                ->create();

        $myCategory = MyOwnCategory::factory()->create();

        $book1 = Book::factory()
            ->for($user)
            ->create([
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

        DB::table('book_author')->insert([
            'book_id' => $book1->id,
            'author_id' => $author->id
        ]);

        $book2 = Book::factory()
            ->for($user)
            ->has(Author::factory()->count(1))
            ->create([
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

        $book3 = Book::factory()
            ->for($user)
            ->has(Author::factory()->count(2))
            ->create([
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

            $authorNameFilter = $author->name;
            $bookTitleFilter = '';
            $proposalFilter = 'All';
            $typeFilter = 'All';
            $myOwnCategoryFilter = -1;

            $managerService = $this->setupManagerService();

            $filters = [
                'author' => $authorNameFilter,
                'title' => $bookTitleFilter,
                'proposal' => $proposalFilter,
                'type' => $typeFilter,
                'my_own_category' => $myOwnCategoryFilter
            ];

            $filteredBook = $managerService->filterBooks($filters, $user->id);

            $this->assertEquals(1, $filteredBook->count());
    }

    public function test_search_a_book()
    {
        $user = User::factory()
        ->create();

        $author= Author::factory()
                ->for($user)
                ->create();

        $myCategory = MyOwnCategory::factory()->create();

        $book1 = Book::factory()
            ->for($user)
            ->create([
                'title' => 'book1',
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

        DB::table('book_author')->insert([
            'book_id' => $book1->id,
            'author_id' => $author->id
        ]);

        $book2 = Book::factory()
            ->for($user)
            ->has(Author::factory()->count(1))
            ->create([
                'title' => 'book2',
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

        $book3 = Book::factory()
            ->for($user)
            ->has(Author::factory()->count(2))
            ->create([
                'title' => 'book3',
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

            $authorNameFilter = $book1->authors()->first()->name;
            $bookTitleFilter = $book1->title;
            $proposalFilter = $book1->proposal;
            $typeFilter = $book1->type;
            $myOwnCategoryFilter = $book1->my_own_category_id;

            $managerService = $this->setupManagerService();

            $filters = [
                'author' => $authorNameFilter,
                'title' => $bookTitleFilter,
                'proposal' => $proposalFilter,
                'type' => $typeFilter,
                'my_own_category' => $myOwnCategoryFilter
            ];

            $filteredBooks = $managerService->filterBooks($filters, $user->id);

            $this->assertEquals(1, $filteredBooks->count());

            $filterBook = $filteredBooks->first();

            $this->assertEquals('book1', $filterBook->title);
    }

    private function setupManagerService(): ManagerService
    {
        $authorRepository = new AuthorRepository();
        $bookRepository = new BookRepository();
        $myCategoryRepository = new OwnCategoryRepository();

        $managerService = new ManagerService($authorRepository,
                                $bookRepository, $myCategoryRepository);

        return $managerService;
    }

}
