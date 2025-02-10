<?php

namespace Tests\Feature;

use App\Livewire\Classification\Classification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\MyOwnCategory;
use Livewire\Livewire;
use App\Enums\Type;
use App\Enums\Proposed;
use App\Livewire\Classification\CategoryTable;

class ClassificationTest extends TestCase
{

    use RefreshDatabase;

    public function test_classifsication_page_is_ok()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $response = $this->get('manager/third_level/classification/'.$book->id);

        $response->assertStatus(200);
    }

    public function test_save_a_classification()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create();

        $myCategory = MyOwnCategory::factory()
                            ->for($user)
                            ->create();

        Livewire::test(Classification::class, ['book' => $book])
            ->assertSet('type', '')
            ->assertSet('proposal', '')
            ->assertSet('myCategory', '')
            ->set('type', Type::THEORETICAL->toString())
            ->set('proposal', Proposed::MATHANDSCIENCE->toString())
            ->set('myCategory', $myCategory->id)
            ->call('saveType')
            ->call('saveProposal')
            ->call('saveMyCategory');

        $updatedBook = Book::find($book->id);

        $this->assertEquals($updatedBook->type, Type::THEORETICAL->toString());
        $this->assertEquals($updatedBook->proposal, Proposed::MATHANDSCIENCE->toString());
        $this->assertEquals($updatedBook->my_own_category_id, $myCategory->id);
    }

    public function test_my_category_page_is_ok()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create();

        $response = $this->get('manager/third_level/my_categories/'.$book->id);

        $response->assertStatus(200);
    }

    public function test_my_category_crud()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create();

        $myCategories = MyOwnCategory::factory()
                            ->for($user)
                            ->count(4)
                            ->create();

        Livewire::test(CategoryTable::class)
            ->assertSet('categoryId', 0)
            ->assertSet('categoryName', '')
            ->assertSet('newCategory', '')
            ->assertViewHas('myCategories', function ($myCategories) {
                return $myCategories->count() === 4;
            })
            ->set('newCategory', 'New Category')
            ->call('createCategory')
            ->assertSet('newCategory', '')
            ->assertViewHas('myCategories', function ($myCategories) {
                return $myCategories->count() === 5;
            })
            ->assertSee('New Category')
            ->call('editCategory', $myCategories->first()->id, $myCategories->first()->name)
            ->assertSet('categoryId', $myCategories->first()->id)
            ->assertSet('categoryName',  $myCategories->first()->name)
            ->set('categoryName', 'Updated Category')
            ->call('updateCategory')
            ->assertSet('categoryId', 0)
            ->assertSet('categoryName', '')
            ->assertSee('Updated Category')
            ->call('deleteCategory', $myCategories->first()->id)
            ->assertViewHas('myCategories', function ($myCategories) {
                return $myCategories->count() === 4;
            });
    }

    public function test_my_category_search()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create();

        $myCategories = MyOwnCategory::factory()
                            ->for($user)
                            ->count(4)
                            ->create();

        Livewire::test(CategoryTable::class)
            ->assertSet('search', '')
            ->assertViewHas('myCategories', function ($myCategories) {
                return $myCategories->count() === 4;
            })
            ->set('search', $myCategories->first()->name)
            ->assertViewHas('myCategories', function ($myCategories) {
                return $myCategories->count() === 1;
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
