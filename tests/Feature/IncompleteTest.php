<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Incomplete;
use App\Models\User;
use App\Livewire\Incomplete\FormIncomplete;
use App\Livewire\Incomplete\Incompletes;

class IncompleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_incomplete_page_is_ok()
    {
         $user = User::factory()
            ->create();

         $this->login($user);

         $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'ok'
            ]);

         $response = $this->get('manager/third_level/incomplete/'.$book->id);
         $response->assertSeeLivewire(Incompletes::class);

         $response->assertStatus(200);
    }

    public function test_incomplete_create_page_is_ok()
    {
         $user = User::factory()
         ->create();

         $this->login($user);

         $book = Book::factory()
         ->for($user)
         ->create([
             'title' => 'ok'
         ]);

         $response = $this->get('manager/third_level/incomplete/create/'.$book->id);
         $response->assertSeeLivewire(FormIncomplete::class);

         $response->assertStatus(200);
    }

    public function test_incomplete_update_page_is_ok()
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

         $response = $this->get('manager/third_level/incomplete/update/'.$incomplete->id.'/'.$book->id);
         $response->assertSeeLivewire(FormIncomplete::class);

         $response->assertStatus(200);
    }

    public function test_incomplete_read_page_is_ok()
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

         $response = $this->get('manager/third_level/incomplete/read/'.$incomplete->id.'/'.$book->id);

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
