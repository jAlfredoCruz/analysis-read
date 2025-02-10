<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use Livewire\Livewire;
use App\Livewire\Unity\Unity;
use App\Models\Synthesis;

class SynthesisTest extends TestCase
{
    use RefreshDatabase;


    public function test_unity_page_is_ok(): void
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create();

        $response = $this->get('manager/third_level/unity/'.$book->id);

        $response->assertStatus(200);
    }

    public function test_save_a_synthesis(): void
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create();

        Livewire::test(Unity::class, ['book' => $book])
            ->assertSet('read', true)
            ->set('read', false)
            ->set('synthesis', 'This is a synthesis')
            ->call('saveSynthesis')
            ->assertSet('read', true);


        $this->assertDatabaseHas('syntheses', [
            'book_id' => $book->id,
            'text' => 'This is a synthesis',
        ]);

        $bookUpdated = Book::find($book->id);
        $synthesisText = Synthesis::where('book_id', $book->id)->first();

        $this->assertEquals('This is a synthesis', $bookUpdated->synthesis->text);
        $this->assertEquals('This is a synthesis', $synthesisText->text);

    }

    public function test_update_a_synthesis()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create();

        $synthesis = Synthesis::factory()
        ->for($book)
        ->create([
            'text' => 'old synthesis'
        ]);

        Livewire::test(Unity::class, ['book' => $book])
            ->assertSet('read', true)
            ->set('read', false)
            ->set('synthesis', 'This is a synthesis')
            ->call('saveSynthesis')
            ->assertSet('read', true);

        $this->assertDatabaseHas('syntheses', [
            'book_id' => $book->id,
            'text' => 'This is a synthesis',
        ]);

        $bookUpdated = Book::find($book->id);
        $synthesis = Synthesis::find($synthesis->id);

        $this->assertEquals('This is a synthesis', $bookUpdated->synthesis->text);
        $this->assertEquals('This is a synthesis', $synthesis->text);
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
