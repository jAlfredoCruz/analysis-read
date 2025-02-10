<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Author;
use App\Models\MyOwnCategory;
use App\Models\Book;
use App\Enums\Proposed;
use App\Enums\Type;
use App\Models\GeneralQuestion;
use Illuminate\Support\Facades\DB;
use App\Repository\GeneralQuestionRepository;
use App\Service\GeneralQuestionService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GeneralQuestionServiceTest extends TestCase
{
    use RefreshDatabase;

   public function test_save_question()
   {
        $user = User::factory()
        ->create();

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
        $answer = "#this is a test";

        $generalQuestionService = $this->generalQuestionServiceSetup();

        $question = $generalQuestionService->saveQuestion($questionNumber, $book1->id, $answer);

        $updatedBook = Book::find($book1->id);

        $this->assertEquals(1, $updatedBook->questions->count());
        $this->assertEquals($questionNumber, $question->question_number);
        $this->assertEquals($answer, $question->answer);
   }

   public function test_save_answer_with_a_existent_question()
   {
        $user = User::factory()
        ->create();

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

       $gq = GeneralQuestion::factory()
            ->for($book1)
            ->create([
                'question_number' => 1,
                'answer' => "#this is a test"
            ]);

        $questionService = $this->generalQuestionServicesetup();
        $newAnswer = "#New answer";

        $question = $questionService->saveQuestion($gq->question_number, $book1->id, $newAnswer);

        $updatedBook = Book::find($book1->id);

        $this->assertEquals(1, $updatedBook->questions->count());
        $this->assertEquals(1, $question->question_number);
        $this->assertEquals($newAnswer, $question->answer);
   }

   private function generalQuestionServiceSetup(): GeneralQuestionService
   {
     $generalQuestionRepository = new GeneralQuestionRepository();
     return new GeneralQuestionService($generalQuestionRepository);

   }
}
