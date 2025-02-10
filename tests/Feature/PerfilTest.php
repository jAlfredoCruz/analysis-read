<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Perfil;
use App\Livewire\Analysis\FormAnalysis;
use App\Livewire\Analysis\Analysis;
use App\Livewire\Analysis\ReadAnalysis;
use Livewire\Livewire;
use Illuminate\Database\Eloquent\Factories\Sequence;

class PerfilTest extends TestCase
{
   public function test_analysis_page_is_ok()
   {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $response = $this->get('manager/third_level/perfil/'.$book->id);

        $response->assertStatus(200);
   }

   public function test_analysis_create_page_is_ok()
   {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $response = $this->get('manager/third_level/perfil/create/'.$book->id);

        $response->assertStatus(200);
   }

   public function test_analysis_update_page_is_ok()
   {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $perfil = Perfil::factory()
                    ->for($book)
                    ->create();

        $response = $this->get('manager/third_level/perfil/update/'.$perfil->id.'/'.$book->id);

        $response->assertStatus(200);
   }

   public function test_analysis_create_perfil()
   {
        $user = User::factory()
                ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        Livewire::test(FormAnalysis::class, ['book' => $book])
            ->set('level', '1.')
            ->set('name', 'perfil 1.1')
            ->set('text', "#this is a text")
            ->call('save')
            ->assertRedirect('manager/third_level/perfil/'.$book->id);

            $this->assertDatabaseHas('perfils', [
                'level' => '1.',
                'name' => 'perfil 1.1',
                'text' => "#this is a text",
                'book_id' => $book->id
            ]);

            $perfil = Perfil::where('book_id', $book->id)->first();
            $bookU = Book::find($book->id);

            $this->assertEquals('#this is a text', $perfil->text);
            $this->assertEquals(1, $bookU->perfils->count());
   }

   public function test_analysis_edit_perfil()
   {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
        'title' => 'update'
        ]);

        $perfil = Perfil::factory()
                    ->for($book)
                    ->create();

        Livewire::test(FormAnalysis::class, ['book' => $book, 'perfil' => $perfil])
        ->assertSet('level', $perfil->level)
        ->assertSet('name', $perfil->name)
        ->assertSet('text', $perfil->text)
        ->set('level', '1.')
        ->set('name', 'perfil 1.1')
        ->set('text', "#this is a text")
        ->call('save')
        ->assertRedirect('manager/third_level/perfil/'.$book->id);

        $perfilUpdated = Perfil::find($perfil->id);

        $this->assertEquals('1.', $perfilUpdated->level);
        $this->assertEquals('perfil 1.1', $perfilUpdated->name);
        $this->assertEquals("#this is a text", $perfilUpdated->text);

   }

   public function test_analysis_view_perfils()
   {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
            ->for($user)
            ->create([
            'title' => 'update'
            ]);

        Perfil::factory()
            ->for($book)
            ->create();

        Livewire::test(Analysis::class, ['book' => $book])
            ->assertViewHas('myPerfils', function($myPerfils){
                return count($myPerfils) == 1;
            });
   }

   public function test_analsis_read_analysis()
   {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
            ->for($user)
            ->create([
            'title' => 'update'
            ]);

        $perfil = Perfil::factory()
                ->for($book)
                ->create();

        Livewire::test(ReadAnalysis::class, ['book' => $book, 'perfil' => $perfil])
            ->assertSet('text', $perfil->text)
            ->asertSet('level', $perfil->level);
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
