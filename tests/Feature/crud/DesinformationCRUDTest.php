<?php

namespace Tests\Feature\crud;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Desinformation;
use App\Livewire\Desinformation\Desinformations;
use App\Livewire\Desinformation\FormDesinformation;
use Livewire\Livewire;
use App\Livewire\DeleteButton;

class DesinformationCRUDTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_desinformation()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $desinformation = Desinformation::factory()
                    ->for($book)
                    ->make();

        Livewire::test(FormDesinformation::class, ['book' => $book])
            ->set('text', $desinformation->text)
            ->call('save')
            ->assertRedirect('manager/third_level/desinformation/'.$book->id);

        $newDesinformation = Desinformation::where('book_id', $book->id)->first();

        $this->assertEquals($newDesinformation->text, $desinformation->text);
    }

    public function test_update_desinformation()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $desinformation = Desinformation::factory()
                ->for($book)
                ->create();

        $desinformationToSave = Desinformation::factory()
                    ->for($book)
                    ->make();

        Livewire::test(FormDesinformation::class, ['book' => $book, 'desinformation' => $desinformation])
            ->assertSet('text', $desinformation->text)
            ->set('text', $desinformationToSave->text)
            ->call('save')
            ->assertRedirect('manager/third_level/desinformation/'.$book->id);

        $newDesinformation = Desinformation::where('book_id', $book->id)->first();

        $this->assertEquals($newDesinformation->text, $desinformationToSave->text);
    }

    public function test_delete_desinformation()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $desinformation = Desinformation::factory()
                ->for($book)
                ->create();

        $desinformation2 = Desinformation::factory()
                    ->for($book)
                    ->create();

        Livewire::test(DeleteButton::class, ['id' => $desinformation->id])
            ->call('delete')
            ->assertDispatched('text-delete');

        Livewire::test(Desinformations::class, ['book' => $book])
            ->assertViewHas('myDesinformations', function ($myDesinformations) {
                return count($myDesinformations) == 2;
            })
            ->dispatch('text-delete', id: $desinformation->id)
            ->assertViewHas('myDesinformations', function ($myDesinformations) {
                return count($myDesinformations) == 1;
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
