<?php

namespace Tests\Feature\crud;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Misinformation;
use App\Models\Book;
use App\Models\User;
use App\Livewire\Misinformation\Misinformations;
use App\Livewire\Misinformation\FormMisinformation;
use App\Livewire\DeleteButton;

class MisinformationCRUDTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_misinformation()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $misinformation = Misinformation::factory()
                    ->for($book)
                    ->make();

        Livewire::test(FormMisinformation::class, ['book' => $book])
            ->set('text', $misinformation->text)
            ->call('save')
            ->assertRedirect('manager/third_level/misinformation/'.$book->id);

        $newMisinformation = Misinformation::where('book_id', $book->id)->first();

        $this->assertEquals($newMisinformation->text, $misinformation->text);
    }

    public function test_update_misinformation()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $misinformation = Misinformation::factory()
                ->for($book)
                ->create();

        $misinformationToSave = Misinformation::factory()
                    ->for($book)
                    ->make();

        Livewire::test(FormMisinformation::class, ['book' => $book, 'misinformation' => $misinformation])
            ->assertSet('text', $misinformation->text)
            ->set('text', $misinformationToSave->text)
            ->call('save')
            ->assertRedirect('manager/third_level/misinformation/'.$book->id);

        $newMisinformation = Misinformation::where('book_id', $book->id)->first();

        $this->assertEquals($newMisinformation->text, $misinformationToSave->text);
    }

    public function test_delete_misinformation()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $misinformation = Misinformation::factory()
                ->for($book)
                ->create();

        $misinformation2 = Misinformation::factory()
                    ->for($book)
                    ->create();

        Livewire::test(DeleteButton::class, ['id' => $misinformation->id])
            ->call('delete')
            ->assertDispatched('text-delete');

        Livewire::test(Misinformations::class, ['book' => $book])
            ->assertViewHas('myMisinformations', function ($myMisinformations) {
                return count($myMisinformations) == 2;
            })
            ->dispatch('text-delete', id: $misinformation->id)
            ->assertViewHas('myMisinformations', function ($myMisinformations) {
                return count($myMisinformations) == 1;
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
