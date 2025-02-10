<?php

namespace Tests\Feature\crud;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\Incomplete;
use App\Models\User;
use App\Models\Book;
use App\Livewire\Incomplete\FormIncomplete;
use App\Livewire\Incomplete\Incompletes;
use App\Livewire\DeleteButton;

class IncompleteCRUDTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_incomplete()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $incomplete = Incomplete::factory()
                    ->for($book)
                    ->make();

        Livewire::test(FormIncomplete::class, ['book' => $book])
            ->set('text', $incomplete->text)
            ->call('save')
            ->assertRedirect('manager/third_level/incomplete/'.$book->id);

        $newIncomplete = Incomplete::where('book_id', $book->id)->first();

        $this->assertEquals($newIncomplete->text, $incomplete->text);
    }

    public function test_update_incomplete()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $incomplete = Incomplete::factory()
                ->for($book)
                ->create();

        $incompleteToSave = Incomplete::factory()
                    ->for($book)
                    ->make();

        Livewire::test(FormIncomplete::class, ['book' => $book, 'incomplete' => $incomplete])
            ->assertSet('text', $incomplete->text)
            ->set('text', $incompleteToSave->text)
            ->call('save')
            ->assertRedirect('manager/third_level/incomplete/'.$book->id);

        $newIncomplete = Incomplete::where('book_id', $book->id)->first();

        $this->assertEquals($newIncomplete->text, $incompleteToSave->text);
    }

    public function test_delete_incomplete()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $incomplete = Incomplete::factory()
                ->for($book)
                ->create();

        $incomplete2 = Incomplete::factory()
                    ->for($book)
                    ->create();

        Livewire::test(DeleteButton::class, ['id' => $incomplete->id])
            ->call('delete')
            ->assertDispatched('text-delete');

        Livewire::test(Incompletes::class, ['book' => $book])
            ->assertViewHas('myIncompletes', function ($myIncompletes) {
                return count($myIncompletes) == 2;
            })
            ->dispatch('text-delete', id: $incomplete->id)
            ->assertViewHas('myIncompletes', function ($myIncompletes) {
                return count($myIncompletes) == 1;
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
