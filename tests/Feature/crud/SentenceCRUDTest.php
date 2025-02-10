<?php

namespace Tests\Feature\crud;

use App\Livewire\Sentence\FormSentence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Sentence;
use Livewire\Livewire;
use App\Livewire\Sentence\Sentences;
use App\Livewire\DeleteButton;

class SentenceCRUDTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_sentence()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $sentence = Sentence::factory()
                    ->for($book)
                    ->make();

        Livewire::test(FormSentence::class, ['book' => $book])
            ->set('text', $sentence->text)
            ->call('save')
            ->assertRedirect('manager/third_level/sentence/'.$book->id);

        $newSentence = Sentence::where('book_id', $book->id)->first();

        $this->assertEquals($newSentence->text, $sentence->text);
    }

    public function test_update_sentence()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $sentence = Sentence::factory()
                ->for($book)
                ->create();

        $sentenceToSave = Sentence::factory()
                    ->for($book)
                    ->make();

        Livewire::test(FormSentence::class, ['book' => $book, 'sentence' => $sentence])
            ->assertSet('text', $sentence->text)
            ->set('text', $sentenceToSave->text)
            ->call('save')
            ->assertRedirect('manager/third_level/sentence/'.$book->id);

        $newSentence = Sentence::where('book_id', $book->id)->first();

        $this->assertEquals($newSentence->text, $sentenceToSave->text);
    }

    public function test_delete_sentence()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $sentence = Sentence::factory()
                ->for($book)
                ->create();

        $sentence2 = Sentence::factory()
                    ->for($book)
                    ->create();

        Livewire::test(DeleteButton::class, ['id' => $sentence->id])
            ->call('delete')
            ->assertDispatched('text-delete');

        Livewire::test(Sentences::class, ['book' => $book])
            ->assertViewHas('mySentences', function ($mySentences) {
                return count($mySentences) == 2;
            })
            ->dispatch('text-delete', id: $sentence->id)
            ->assertViewHas('mySentences', function ($mySentences) {
                return count($mySentences) == 1;
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
