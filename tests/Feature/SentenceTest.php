<?php

namespace Tests\Feature;

use App\Livewire\Sentence\FormSentence;
use App\Livewire\Sentence\Sentences;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Sentence;

class SentenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_sentence_page_is_ok()
    {
         $user = User::factory()
            ->create();

         $this->login($user);

         $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'ok'
            ]);

         $response = $this->get('manager/third_level/sentence/'.$book->id);
         $response->assertSeeLivewire(Sentences::class);

         $response->assertStatus(200);
    }

    public function test_sentence_create_page_is_ok()
    {
         $user = User::factory()
         ->create();

         $this->login($user);

         $book = Book::factory()
         ->for($user)
         ->create([
             'title' => 'ok'
         ]);

         $response = $this->get('manager/third_level/sentence/create/'.$book->id);
         $response->assertSeeLivewire(FormSentence::class);

         $response->assertStatus(200);
    }

    public function test_sentence_update_page_is_ok()
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

         $response = $this->get('manager/third_level/sentence/update/'.$sentence->id.'/'.$book->id);
         $response->assertSeeLivewire(FormSentence::class);

         $response->assertStatus(200);
    }

    public function test_sentence_read_page_is_ok()
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

         $response = $this->get('manager/third_level/sentence/read/'.$sentence->id.'/'.$book->id);

         $response->assertStatus(200);
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
