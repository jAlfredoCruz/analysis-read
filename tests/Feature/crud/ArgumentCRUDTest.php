<?php

namespace Tests\Feature\crud;

use App\Models\Argument;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;
use App\Models\User;
use App\Models\Book;
use App\Livewire\Argument\Arguments;
use App\Livewire\Argument\FormArgument;
use App\Livewire\DeleteButton;

class ArgumentCRUDTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_argument()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $argument = Argument::factory()
                    ->for($book)
                    ->make();

        Livewire::test(FormArgument::class, ['book' => $book])
            ->set('text', $argument->text)
            ->call('save')
            ->assertRedirect('manager/third_level/argument/'.$book->id);

        $newArgument = Argument::where('book_id', $book->id)->first();

        $this->assertEquals($newArgument->text, $argument->text);
    }

    public function test_update_argument()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $argument = Argument::factory()
                ->for($book)
                ->create();

        $argumentToSave = Argument::factory()
                    ->for($book)
                    ->make();

        Livewire::test(FormArgument::class, ['book' => $book, 'argument' => $argument])
            ->assertSet('text', $argument->text)
            ->set('text', $argumentToSave->text)
            ->call('save')
            ->assertRedirect('manager/third_level/argument/'.$book->id);

        $newArgument = Argument::where('book_id', $book->id)->first();

        $this->assertEquals($newArgument->text, $argumentToSave->text);
    }

    public function test_delete_argument()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $argument = Argument::factory()
                ->for($book)
                ->create();

        $argument2 = Argument::factory()
                    ->for($book)
                    ->create();

        Livewire::test(DeleteButton::class, ['id' => $argument->id])
            ->call('delete')
            ->assertDispatched('text-delete');

        Livewire::test(Arguments::class, ['book' => $book])
            ->assertViewHas('myArguments', function ($myArguments) {
                return count($myArguments) == 2;
            })
            ->dispatch('text-delete', id: $argument->id)
            ->assertViewHas('myArguments', function ($myArguments) {
                return count($myArguments) == 1;
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
