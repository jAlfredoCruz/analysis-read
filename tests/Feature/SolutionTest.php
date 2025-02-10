<?php

namespace Tests\Feature;

use App\Livewire\Problem\FormAnswer;
use App\Livewire\Problem\Problems;
use App\Livewire\Problem\ReadProblem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Problem;
use Livewire\Livewire;

class SolutionTest extends TestCase
{
    use RefreshDatabase;

    public function test_solution_page_is_ok()
    {
         $user = User::factory()
            ->create();

         $this->login($user);

         $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'ok'
            ]);

         $response = $this->get('manager/third_level/solution/'.$book->id);
         $response->assertSeeLivewire(Problems::class);

         $response->assertStatus(200);
    }


    public function test_update_answer_page_is_ok()
    {
         $user = User::factory()
            ->create();

         $this->login($user);

         $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'ok'
            ]);

        $problem = Problem::factory()
            ->for($book)
            ->create();

         $response = $this->get('manager/third_level/solution/update/'.$problem->id.'/'.$book->id);
         $response->assertSeeLivewire(FormAnswer::class);

         $response->assertStatus(200);
    }

   public function test_read_answer_page_is_ok()
    {
         $user = User::factory()
            ->create();

         $this->login($user);

         $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'ok'
            ]);

            $problem = Problem::factory()
            ->for($book)
            ->create();

         $response = $this->get('manager/third_level/solution/read/'.$problem->id.'/'.$book->id);
         $response->assertSeeLivewire(ReadProblem::class);

         $response->assertStatus(200);
    }

    public function test_solution_edit()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
        'title' => 'update'
        ]);

        $problem = Problem::factory()
                    ->for($book)
                    ->create();

        Livewire::test(FormAnswer::class, ['book' => $book, 'problem' => $problem])
        ->assertSet('text', '')
        ->set('text', "#this is a text")
        ->call('save')
        ->assertRedirect('manager/third_level/solution/read/'.$problem->id.'/'.$book->id);

        $problemUpdated = Problem::find($problem->id);

        $this->assertEquals("#this is a text", $problemUpdated->solution);
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
