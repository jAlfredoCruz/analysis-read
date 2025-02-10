<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Argument;
use App\Models\Book;
use App\Models\User;
use App\Livewire\Argument\Arguments;
use App\Livewire\Argument\FormArgument;

class ArgumentTest extends TestCase
{
    use RefreshDatabase;

    public function test_argument_page_is_ok()
    {
         $user = User::factory()
            ->create();

         $this->login($user);

         $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'ok'
            ]);

         $response = $this->get('manager/third_level/argument/'.$book->id);
         $response->assertSeeLivewire(Arguments::class);

         $response->assertStatus(200);
    }

    public function test_argument_create_page_is_ok()
    {
         $user = User::factory()
         ->create();

         $this->login($user);

         $book = Book::factory()
         ->for($user)
         ->create([
             'title' => 'ok'
         ]);

         $response = $this->get('manager/third_level/argument/create/'.$book->id);
         $response->assertSeeLivewire(FormArgument::class);

         $response->assertStatus(200);
    }

    public function test_argument_update_page_is_ok()
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

         $response = $this->get('manager/third_level/argument/update/'.$argument->id.'/'.$book->id);
         $response->assertSeeLivewire(FormArgument::class);

         $response->assertStatus(200);
    }

    public function test_argument_read_page_is_ok()
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

         $response = $this->get('manager/third_level/argument/read/'.$argument->id.'/'.$book->id);

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
