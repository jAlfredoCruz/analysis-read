<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Problem;
use App\Livewire\Problem\FormProblem;
use App\Livewire\Problem\Problems;
use App\Livewire\Problem\ReadProblem;
use App\Livewire\Problem\FormAnswer;
use Livewire\Livewire;
use Illuminate\Support\Str;

class ProblemTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_problems_page_is_ok()
    {
         $user = User::factory()
         ->create();

         $this->login($user);

         $book = Book::factory()
         ->for($user)
         ->create([
             'title' => 'ok'
         ]);

         $response = $this->get('manager/third_level/problem/'.$book->id);
         $response->assertSeeLivewire(Problems::class);

         $response->assertStatus(200);
    }

    public function test_problem_create_page_is_ok()
    {
         $user = User::factory()
         ->create();

         $this->login($user);

         $book = Book::factory()
         ->for($user)
         ->create([
             'title' => 'ok'
         ]);

         $response = $this->get('manager/third_level/problem/create/'.$book->id);
         $response->assertSeeLivewire(FormProblem::class);

         $response->assertStatus(200);
    }

    public function test_problem_update_page_is_ok()
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

         $response = $this->get('manager/third_level/problem/update/'.$problem->id.'/'.$book->id);
         $response->assertSeeLivewire(FormProblem::class);

         $response->assertStatus(200);
    }

    public function test_problem_read_page_is_ok()
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

         $response = $this->get('manager/third_level/problem/read/'.$problem->id.'/'.$book->id);
         $response->assertSeeLivewire(ReadProblem::class);

         $response->assertStatus(200);
    }

 /** public function test_read_problems()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
        ->for($user)
        ->create([
            'title' => 'ok'
        ]);

        $problem1 = Problem::factory()
                ->for($book)
                ->create([
                    'level' => '1.'
                ]);

        $problem2 = Problem::factory()
                ->for($book)
                ->create([
                    'level' => '1.1'
                ]);

        Livewire::test(Problems::class, ['book' => $book])
            ->assertViewHas('myProblems', function($myProblems){
                return count($myProblems) == 2;
            });
    } */

    public function test_create_a_problem()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'ok'
            ]);

        Livewire::test(FormProblem::class, ['book' => $book])
            ->set('level', '1.')
            ->set('name', 'perfil 1.1')
            ->set('text', "#this is a text")
            ->call('save')
            ->assertRedirect('manager/third_level/problem/'.$book->id);

            $perfil = Problem::where('book_id', $book->id)->first();
            $bookU = Book::find($book->id);

            $this->assertEquals('#this is a text', $perfil->text);
            $this->assertEquals(1, $bookU->problems->count());
    }

    public function test_problems_edit_problem()
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

         Livewire::test(FormProblem::class, ['book' => $book, 'problem' => $problem])
         ->assertSet('level', $problem->level)
         ->assertSet('name', $problem->name)
         ->assertSet('text', $problem->text)
         ->set('level', '1.')
         ->set('name', 'perfil 1.1')
         ->set('text', "#this is a text")
         ->call('save')
         ->assertRedirect('manager/third_level/problem/'.$book->id);

         $problemUpdated = Problem::find($problem->id);

         $this->assertEquals('1.', $problemUpdated->level);
         $this->assertEquals('perfil 1.1', $problemUpdated->name);
         $this->assertEquals("#this is a text", $problemUpdated->text);
    }

    public function test_read_a_problem()
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

        Livewire::test(ReadProblem::class, ['book' => $book, 'problem' => $problem])
            ->assertSet('problemText', Str::markdown($problem->text))
            ->assertSet('answerText', '');
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
