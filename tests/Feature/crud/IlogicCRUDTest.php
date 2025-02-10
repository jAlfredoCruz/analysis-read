<?php

namespace Tests\Feature\crud;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;
use App\Models\User;
use App\Models\Book;
use App\Livewire\Ilogic\FormIlogic;
use App\Livewire\Ilogic\Ilogics;
use App\Models\Ilogic;
use App\Livewire\DeleteButton;

class IlogicCRUDTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_ilogic()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $ilogic = Ilogic::factory()
                    ->for($book)
                    ->make();

        Livewire::test(FormIlogic::class, ['book' => $book])
            ->set('text', $ilogic->text)
            ->call('save')
            ->assertRedirect('manager/third_level/ilogic/'.$book->id);

        $newIlogic = Ilogic::where('book_id', $book->id)->first();

        $this->assertEquals($newIlogic->text, $ilogic->text);
    }

    public function test_update_ilogic()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $ilogic = Ilogic::factory()
                ->for($book)
                ->create();

        $ilogicToSave = Ilogic::factory()
                    ->for($book)
                    ->make();

        Livewire::test(FormIlogic::class, ['book' => $book, 'ilogic' => $ilogic])
            ->assertSet('text', $ilogic->text)
            ->set('text', $ilogicToSave->text)
            ->call('save')
            ->assertRedirect('manager/third_level/ilogic/'.$book->id);

        $newIlogic = Ilogic::where('book_id', $book->id)->first();

        $this->assertEquals($newIlogic->text, $ilogicToSave->text);
    }

    public function test_delete_ilogic()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $ilogic = Ilogic::factory()
                ->for($book)
                ->create();

        $ilogic2 = Ilogic::factory()
                    ->for($book)
                    ->create();

        Livewire::test(DeleteButton::class, ['id' => $ilogic->id])
            ->call('delete')
            ->assertDispatched('text-delete');

        Livewire::test(Ilogics::class, ['book' => $book])
            ->assertViewHas('myIlogics', function ($myIlogics) {
                return count($myIlogics) == 2;
            })
            ->dispatch('text-delete', id: $ilogic->id)
            ->assertViewHas('myIlogics', function ($myIlogics) {
                return count($myIlogics) == 1;
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
