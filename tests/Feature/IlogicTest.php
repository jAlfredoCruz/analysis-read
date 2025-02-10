<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Ilogic;
use App\Models\User;
use App\Livewire\Ilogic\FormIlogic;
use App\Livewire\Ilogic\Ilogics;


class IlogicTest extends TestCase
{
    use RefreshDatabase;

    public function test_ilogic_page_is_ok()
    {
         $user = User::factory()
            ->create();

         $this->login($user);

         $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'ok'
            ]);

         $response = $this->get('manager/third_level/ilogic/'.$book->id);
         $response->assertSeeLivewire(Ilogics::class);

         $response->assertStatus(200);
    }

    public function test_ilogic_create_page_is_ok()
    {
         $user = User::factory()
         ->create();

         $this->login($user);

         $book = Book::factory()
         ->for($user)
         ->create([
             'title' => 'ok'
         ]);

         $response = $this->get('manager/third_level/ilogic/create/'.$book->id);
         $response->assertSeeLivewire(FormIlogic::class);

         $response->assertStatus(200);
    }

    public function test_ilogic_update_page_is_ok()
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

         $response = $this->get('manager/third_level/ilogic/update/'.$ilogic->id.'/'.$book->id);
         $response->assertSeeLivewire(FormIlogic::class);

         $response->assertStatus(200);
    }

    public function test_ilogic_read_page_is_ok()
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

         $response = $this->get('manager/third_level/ilogic/read/'.$ilogic->id.'/'.$book->id);

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
