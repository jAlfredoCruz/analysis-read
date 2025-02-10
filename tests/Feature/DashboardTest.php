<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use App\Models\Author;
use App\Models\User;
use App\Models\Book;
use App\Livewire\Dashboard\CreateBookForm;
use App\Livewire\Dashboard\ManagerAuthor;
use App\Livewire\Book\BookList;
use App\Livewire\Dashboard\FilterModal;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Enums\Proposed;
use App\Enums\Type;
use App\Models\MyOwnCategory;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_book_form_component()
    {
        $user = User::factory()
            ->has(Author::factory()->count(3))
            ->create();

        $this->login($user);

        Livewire::test(CreateBookForm::class)
            ->assertViewHas('authorsOptions', function ($authorsOptions) {
                return count($authorsOptions) == 3;
            });
    }


   public function test_create_a_new_book_with_new_author()
    {
        $user = User::factory()
            ->create();

        $this->login($user);

        Livewire::test(CreateBookForm::class)
            ->set('title', 'How to read a book')
            ->set('isbn', '134678898-789')
            ->set('authors.1.name','Mortimer J. Adler' )
            ->set('authors.2.name', 'Charles Van Doren')
            ->assertSet('title', 'How to read a book' )
            ->assertSet('isbn', '134678898-789' )
            ->assertSet('authors.1.name','Mortimer J. Adler')
            ->assertSet('authors.2.name', 'Charles Van Doren')
            ->call("save")
            ->assertSet('title', '' )
            ->assertSet('isbn', '' )
            ->assertSet('authors', []);


        $bookUser = Book::where('user_id', $user->id)->first();
        $this->assertEquals('How to read a book', $bookUser->title);
        $this->assertEquals('134678898-789', $bookUser->isbn);
        $book = Book::find($bookUser->id);
        $this->assertEquals(2, count($book->authors));
    }

    public function test_update_the_name_of_a_book()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $authors = Author::factory()
                       ->state(
                        new Sequence(
                            ['name' => 'author1'],
                            ['name' => 'author2']
                        )
                       )
                        ->count(2);

        $book = Book::factory()
                    ->for($user)
                    ->has($authors)
                    ->create();

        $author1 = $book->authors->first();
        $author2 = $book->authors->last();

        Livewire::test(CreateBookForm::class, ['book' => $book ])
            ->assertSet('title', $book->title)
            ->assertSet('isbn', $book->isbn)
            ->assertSet('authors.0.name',$author1->name)
            ->assertSet('authors.1.name', $author2->name)
            ->set('title', 'How to read a book')
            ->set('authors.3.name', "New Author")
            ->call("save")
            ->assertSet('title', '' )
            ->assertSet('isbn', '' )
            ->assertSet('authors', []);


        $bookUser = Book::where('user_id', $user->id)->first();
        $this->assertEquals('How to read a book', $bookUser->title);
        $this->assertEquals($book->isbn, $bookUser->isbn);
        $book = Book::find($bookUser->id);
        $this->assertEquals(3, count($book->authors));
    }

    public function test_update_an_author_name()
    {
        $user = User::factory()
                ->create();

        $this->login($user);

        $authors = Author::factory()
                ->for($user)
                ->state(
                    new Sequence(
                        ['name' => 'author1'],
                        ['name' => 'author2']
                    )
                   )
                ->count(2)
                ->create();

        $author1 = $authors->first();

        Livewire::test(ManagerAuthor::class)
                ->assertViewHas('authorsFiltered', function ($authorsFiltered) {
                    return count($authorsFiltered) == 2;
                })
                ->assertSet('authorId', -1)
                ->assertSet('name', '')
                ->call('openIsUpdated', authorId: $author1->id)
                ->assertSet('authorId', $author1->id)
                ->assertSet('name', $author1->name)
                ->set('name', 'New Author Name')
                ->call('updateAuthor')
                ->assertSet('name', '')
                ->assertSet('authorId', -1);

        $author1 = Author::find($author1->id);
        $this->assertEquals('New Author Name', $author1->name);

    }

    public function test_search_author_name_in_authors()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $authors = Author::factory()
                ->for($user)
                ->state(
                    new Sequence(
                        ['name' => 'author1'],
                        ['name' => 'author2'],
                        ['name' => 'author3']
                    )
                )
                ->count(3)
                ->create();

        Livewire::test(ManagerAuthor::class)
        ->assertViewHas('authorsFiltered', function ($authorsFiltered) {
            return count($authorsFiltered) == 3;
        })
        ->set('search', 'author3')
        ->assertSet('search', 'author3')
        ->assertViewHas('authorsFiltered', function ($authorsFiltered) {
            return count($authorsFiltered) == 1;
        });
    }

    public function test_show_the_list_of_books()
    {
        $user = User::factory()
                ->create();

        $this->login($user);

        $author= Author::factory()
        ->create();

        $author2= Author::factory()
        ->create();

        $author3 = Author::factory()
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

        DB::table('book_author')->insert([
            'book_id' => $book2->id,
            'author_id' => $author2->id
        ]);

        $book3 = Book::factory()
            ->for($user)
            ->has(Author::factory()->count(2))
            ->create([
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

        DB::table('book_author')->insert([
            'book_id' => $book3->id,
            'author_id' => $author3->id
        ]);

        Livewire::test(BookList::class)
        ->assertViewHas('myBooks', function ($myBooks) {
            return count($myBooks) == 3;
        });

    }

    public function test_show_the_list_of_filtered_books()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $author= Author::factory()
        ->for($user)
        ->create();

        $author2= Author::factory()
        ->for($user)
        ->create();

        $author3 = Author::factory()
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

        DB::table('book_author')->insert([
            'book_id' => $book2->id,
            'author_id' => $author2->id
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

        DB::table('book_author')->insert([
            'book_id' => $book3->id,
            'author_id' => $author3->id
        ]);

        $bookList = Livewire::test(BookList::class)
        ->assertViewHas('myBooks', function ($myBooks) {
            return count($myBooks) == 3;
        });

        Livewire::test(FilterModal::class)
            ->set('title', $book1->title)
            ->assertSet('title', $book1->title)
            ->set('author', $author->name)
            ->assertSet('author', $author->name)
            ->set('type', $book1->type)
            ->assertSet('type', $book1->type)
            ->set('proposal', $book1->proposal)
            ->assertSet('proposal', $book1->proposal)
            ->set('category', $book1->my_own_category_id)
            ->assertSet('category', $myCategory->id)
            ->call('filter')
            ->assertDispatched('filter-books');


            $filters = [
                'author' =>  $book1->authors()->first()->name,
                'title' => $book1->title,
                'proposal' => $book1->proposal,
                'type' => $book1->type,
                'my_own_category' => $book1->my_own_category_id
            ];

        $bookList->dispatch('filter-books', filters: $filters)
        ->assertViewHas('myBooks', function ($myBooks) {
            return count($myBooks) == 1;
        });
    }

    private function login($user)
    {
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

}
