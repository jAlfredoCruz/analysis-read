<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Term;
use App\Models\Book;
use App\Livewire\Terms\TermDefinition;
use App\Livewire\Terms\FormTerm;
use Livewire\Livewire;
use App\Livewire\DeleteButton;

class TermCRUDTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_term()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $term = Term::factory()
                    ->for($book)
                    ->make();

        Livewire::test(FormTerm::class, ['book' => $book])
            ->set('name', $term->name)
            ->set('definition', $term->definition)
            ->call('save')
            ->assertRedirect('manager/third_level/term/'.$book->id);

        $newTerm = Term::where('book_id', $book->id)->first();

        $this->assertEquals($newTerm->name, $term->name);
        $this->assertEquals($newTerm->definition, $term->definition);
    }

    public function test_update_term()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $term = Term::factory()
                ->for($book)
                ->create();

        $termToSave = Term::factory()
                    ->for($book)
                    ->make();

        Livewire::test(FormTerm::class, ['book' => $book, 'term' => $term])
            ->assertSet('name', $term->name)
            ->assertSet('definition', $term->definition)
            ->set('name', $termToSave->name)
            ->set('definition', $termToSave->definition)
            ->call('save')
            ->assertRedirect('manager/third_level/term/'.$book->id);

        $newTerm = Term::where('book_id', $book->id)->first();

        $this->assertEquals($newTerm->name, $termToSave->name);
        $this->assertEquals($newTerm->definition, $termToSave->definition);
    }

    public function test_delete_term()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $term = Term::factory()
                ->for($book)
                ->create();

        $term2 = Term::factory()
                    ->for($book)
                    ->create();

        Livewire::test(DeleteButton::class, ['id' => $term->id])
            ->call('delete')
            ->assertDispatched('text-delete');

        Livewire::test(TermDefinition::class, ['book' => $book])
            ->assertViewHas('myTerms', function ($myTerms) {
                return count($myTerms) == 2;
            })
            ->dispatch('text-delete', id: $term->id)
            ->assertViewHas('myTerms', function ($myTerms) {
                return count($myTerms) == 1;
            });
    }

   /**  public function test_read_term()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $term = Term::factory()
                ->for($book)
                ->create();

        $term2 = Term::factory()
                    ->for($book)
                    ->create();


        Livewire::test(TermDefinition::class, ['book' => $book])
            ->assertViewHas('myTerms', function ($myTerms) {
                return count($myTerms) == 2;
            })
            ->set('search', $term->name)
            ->call('render')
            ->assertViewHas('myTerms', function ($myTerms) {
                return count($myTerms) == 1;
            });
    } */

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
