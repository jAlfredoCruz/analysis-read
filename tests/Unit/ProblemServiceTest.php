<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Book;
use App\Models\User;
use App\Models\Problem;
use App\Repository\ProblemRepository;
use App\Service\ProblemService;

class ProblemServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_save_a_Problem()
    {
        $user = User::factory()->create();

        $book = Book::factory()
                ->for($user)
                ->create();

        $problemToSave = Problem::factory()
                            ->for($book)
                            ->make();

        $problemService = $this->setupProblemService();

        $problemService->saveProblem($problemToSave);

        $this->assertDatabaseHas('Problems', [
            'name' => $problemToSave->name,
            'level' => $problemToSave->level,
            'text' => $problemToSave->text,
            'solution' => null,
            'book_id' => $problemToSave->book_id
        ]);

        $bookUpdated = Book::find($book->id);

        $this->assertEquals(1, $bookUpdated->problems->count());
        $this->assertEquals($problemToSave->name, $bookUpdated->problems->first()->name);
    }

    public function test_update_a_Problem()
    {
        $user = User::factory()->create();

        $book = Book::factory()
                ->for($user)
                ->create();
        $problemToSave = Problem::factory()
                            ->for($book)
                            ->create();
        $problemToUpdate = Problem::factory()
                            ->for($book)
                            ->make();
        $problemService = $this->setupProblemService();

        $problemService->updateProblem($problemToSave->id, $problemToUpdate);

        $this->assertDatabaseHas('Problems', [
            'name' => $problemToUpdate->name,
            'level' => $problemToUpdate->level,
            'text' => $problemToUpdate->text,
            'solution' => null,
            'book_id' => $problemToUpdate->book_id
        ]);

        $bookUpdated = Book::find($book->id);

        $this->assertEquals(1, $bookUpdated->problems->count());
        $this->assertEquals($problemToUpdate->name, $bookUpdated->Problems->first()->name);
    }

    public function test_delete_a_Problem()
    {
        $user = User::factory()->create();

        $book = Book::factory()
                ->for($user)
                ->create();
        $problem = Problem::factory()
                            ->for($book)
                            ->create();

        $problemService = $this->setupProblemService();

        $problemService->deleteProblem($problem->id);

        $this->assertDatabaseMissing('Problems', [
            'name' => $problem->name,
            'level' => $problem->level,
            'text' => $problem->text,
            'solution' => null,
            'book_id' => $problem->book_id
        ]);

        $bookUpdated = Book::find($book->id);

        $this->assertEquals(0, $bookUpdated->Problems->count());
    }

    public function test_has_subordinate_problems()
    {
        $user = User::factory()->create();

        $book = Book::factory()
                ->for($user)
                ->create();
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

        $problemService = $this->setupProblemService();

        $sub1 = $problemService->hasSubordinate($problem1);
        $this->assertEquals(true, $sub1);

        $sub2 = $problemService->hasSubordinate($problem2);
        $this->assertEquals(false, $sub2);
    }

    public function test_search_problems()
    {
        $user = User::factory()->create();

        $book = Book::factory()
                ->for($user)
                ->create();
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

        $problems = Problem::where('book_id', $book->id)->get();

        $problemService = $this->setupProblemService();

        $filters = $problemService->filterProblems('',$problems, $book->id);
        $this->assertEquals(2, count($filters));

        $filters = $problemService->filterProblems('1.1', $problems, $book->id);
        $this->assertEquals(1, count($filters));
    }

    public function setupProblemService(): ProblemService
    {
        $ProblemRepository = new ProblemRepository();

        return new ProblemService($ProblemRepository);
    }
}
