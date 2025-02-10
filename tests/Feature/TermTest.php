<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Term;
use App\Livewire\Terms\TermDefinition;
use App\Livewire\Terms\FormTerm;
use Livewire\Livewire;

class TermTest extends TestCase
{
    use RefreshDatabase;

    public function test_terms_page_is_ok()
    {
         $user = User::factory()
            ->create();

         $this->login($user);

         $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'ok'
            ]);

         $response = $this->get('manager/third_level/term/'.$book->id);
         $response->assertSeeLivewire(TermDefinition::class);

         $response->assertStatus(200);
    }

    public function test_term_create_page_is_ok()
    {
         $user = User::factory()
         ->create();

         $this->login($user);

         $book = Book::factory()
         ->for($user)
         ->create([
             'title' => 'ok'
         ]);

         $response = $this->get('manager/third_level/term/create/'.$book->id);
         $response->assertSeeLivewire(FormTerm::class);

         $response->assertStatus(200);
    }

    public function test_term_update_page_is_ok()
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

         $response = $this->get('manager/third_level/term/update/'.$term->id.'/'.$book->id);
         $response->assertSeeLivewire(FormTerm::class);

         $response->assertStatus(200);
    }

    public function test_term_read_page_is_ok()
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

         $response = $this->get('manager/third_level/term/read/'.$term->id.'/'.$book->id);

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
