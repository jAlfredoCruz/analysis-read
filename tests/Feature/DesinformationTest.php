<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Desinformation;
use App\Livewire\Desinformation\Desinformations;
use App\Livewire\Desinformation\FormDesinformation;


class DesinformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_desinformation_page_is_ok()
    {
         $user = User::factory()
            ->create();

         $this->login($user);

         $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'ok'
            ]);

         $response = $this->get('manager/third_level/desinformation/'.$book->id);
         $response->assertSeeLivewire(Desinformations::class);

         $response->assertStatus(200);
    }

    public function test_desinformation_create_page_is_ok()
    {
         $user = User::factory()
         ->create();

         $this->login($user);

         $book = Book::factory()
         ->for($user)
         ->create([
             'title' => 'ok'
         ]);

         $response = $this->get('manager/third_level/desinformation/create/'.$book->id);
         $response->assertSeeLivewire(FormDesinformation::class);

         $response->assertStatus(200);
    }

    public function test_desinformation_update_page_is_ok()
    {
         $user = User::factory()
         ->create();

         $this->login($user);

         $book = Book::factory()
         ->for($user)
         ->create([
             'title' => 'ok'
         ]);

         $desinformation = Desinformation::factory()
                     ->for($book)
                     ->create();

         $response = $this->get('manager/third_level/desinformation/update/'.$desinformation->id.'/'.$book->id);
         $response->assertSeeLivewire(FormDesinformation::class);

         $response->assertStatus(200);
    }

    public function test_desinformation_read_page_is_ok()
    {
         $user = User::factory()
         ->create();

         $this->login($user);

         $book = Book::factory()
         ->for($user)
         ->create([
             'title' => 'ok'
         ]);

         $desinformation = Desinformation::factory()
                     ->for($book)
                     ->create();

         $response = $this->get('manager/third_level/desinformation/read/'.$desinformation->id.'/'.$book->id);

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
