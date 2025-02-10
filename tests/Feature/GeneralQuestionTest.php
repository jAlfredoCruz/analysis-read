<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Author;
use App\Models\Book;
use App\Models\MyOwnCategory;
use App\Enums\Proposed;
use App\Enums\Type;
use Illuminate\Support\Facades\DB;
use App\Models\GeneralQuestion;
use Livewire\Livewire;
use App\Livewire\SecondLevel\Question;

class GeneralQuestionTest extends TestCase
{
    use RefreshDatabase;

    public function test_questions_page_render()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $author= Author::factory()
        ->for($user)
        ->create();

        $myCategory = MyOwnCategory::factory()->create();

        $book1 = Book::factory()
            ->for($user)
            ->create([
                'title' => 'book1',
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

        DB::table('book_author')->insert([
            'book_id' => $book1->id,
            'author_id' => $author->id
        ]);

        $response = $this->get('manager/second_level/questions/'.$book1->id);

        $response->assertStatus(200);
    }

    public function test_question_page_render(): void
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $author= Author::factory()
        ->for($user)
        ->create();

        $myCategory = MyOwnCategory::factory()->create();

        $book1 = Book::factory()
            ->for($user)
            ->create([
                'title' => 'book1',
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

        DB::table('book_author')->insert([
            'book_id' => $book1->id,
            'author_id' => $author->id
        ]);

        $question = GeneralQuestion::factory()
                    ->for($book1)
                    ->create([
                        'question_number' => 1
                    ]);

        $response = $this->get('manager/second_level/'.$question->id.'/'.$question->book->id);

        $response->assertStatus(200);

    }

    public function test_save_a_new_question()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $author= Author::factory()
        ->for($user)
        ->create();

        $myCategory = MyOwnCategory::factory()->create();

        $book1 = Book::factory()
            ->for($user)
            ->create([
                'title' => 'book1',
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

        DB::table('book_author')->insert([
            'book_id' => $book1->id,
            'author_id' => $author->id
        ]);

        $questionNumber = 1;
        $answer = "#This is an answer";

        Livewire::test(Question::class, ['question' => $questionNumber, 'book' => $book1])
                    ->assertSee('¿De que trata el libro como un todo?')
                    ->set('answer', $answer)
                    ->assertSet('answer', $answer)
                    ->call('save')
                    ->assertRedirect('manager/second_level/questions/'. $book1->id);

        $question = GeneralQuestion::where('question_number', $questionNumber)
                        ->where('book_id', $book1->id)
                        ->first();

        $this->assertEquals($answer, $question->answer);

    }

    public function test_save_a_question()
    {
        $user = User::factory()
        ->create();

        $this->login($user);

        $author= Author::factory()
        ->for($user)
        ->create();

        $myCategory = MyOwnCategory::factory()->create();

        $book1 = Book::factory()
            ->for($user)
            ->create([
                'title' => 'book1',
                'type' => Type::PRACTICAL->toString(),
                'proposal' => Proposed::PRACTICAL->toString(),
                'my_own_category_id' => $myCategory->id
            ]);

        DB::table('book_author')->insert([
            'book_id' => $book1->id,
            'author_id' => $author->id
        ]);

        $questionNumber = 1;
        $answer = "#This is an answer";

        $question = GeneralQuestion::factory()
                    ->for($book1)
                    ->create([
                        'question_number' => $questionNumber,
                        'answer' => 'old answer'
                    ]);

        Livewire::test(Question::class, ['question' => $question->question_number, 'book' => $book1])
                    ->assertSee('¿De que trata el libro como un todo?')
                    ->set('answer', $question->answer)
                    ->assertSet('answer', 'old answer')
                    ->set('answer', $answer)
                    ->call('save')
                    ->assertRedirect('manager/second_level/questions/'. $book1->id);

        $questionUpdated = GeneralQuestion::find($question->id);

        $this->assertEquals($answer, $questionUpdated->answer);
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
