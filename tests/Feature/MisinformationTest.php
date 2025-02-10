<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Misinformation;
use App\Models\User;
use App\Livewire\Misinformation\Misinformations;
use App\Livewire\Misinformation\FormMisinformation;

class MisinformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_misinformation_page_is_ok()
    {
         $user = User::factory()
            ->create();

         $this->login($user);

         $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'ok'
            ]);

         $response = $this->get('manager/third_level/misinformation/'.$book->id);
         $response->assertSeeLivewire(Misinformations::class);

         $response->assertStatus(200);
    }

    public function test_misinformation_create_page_is_ok()
    {
         $user = User::factory()
         ->create();

         $this->login($user);

         $book = Book::factory()
         ->for($user)
         ->create([
             'title' => 'ok'
         ]);

         $response = $this->get('manager/third_level/misinformation/create/'.$book->id);
         $response->assertSeeLivewire(FormMisinformation::class);

         $response->assertStatus(200);
    }

    public function test_misinformation_update_page_is_ok()
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

         $response = $this->get('manager/third_level/misinformation/update/'.$misinformation->id.'/'.$book->id);
         $response->assertSeeLivewire(FormMisinformation::class);

         $response->assertStatus(200);
    }

    public function test_misinformation_read_page_is_ok()
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

         $response = $this->get('manager/third_level/misinformation/read/'.$misinformation->id.'/'.$book->id);

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
