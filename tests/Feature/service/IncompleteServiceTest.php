<?php

namespace Tests\Feature\service;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Incomplete;
use App\Repository\IncompleteRepository;
use App\Service\IncompleteService;

class IncompleteServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_a_incomplete()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $incomplete = Incomplete::factory()
                    ->for($book)
                    ->make();

        $incompleteService = $this->incompleteServiceSetup();

        $incompleteService->saveincomplete($incomplete);

        $this->assertDatabaseHas('incompletes', [
            'book_id' => $book->id,
            'text' => $incomplete->text
        ]);

        $bookUpdated = Book::find($book->id);
        $incompleteU = Incomplete::where('book_id', $book->id)->first();

        $this->assertEquals(1, $bookUpdated->incompletes()->count());
        $this->assertEquals($incomplete->text, $incompleteU->text);
    }

    public function test_update_a_incomplete()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $incomplete = Incomplete::factory()
                    ->for($book)
                    ->create();

        $incompleteToSave = Incomplete::factory()
                ->for($book)
                ->make();

        $incompleteService = $this->incompleteServiceSetup();

        $incompleteService->updateincomplete($incomplete->id, $incompleteToSave);

        $incompleteU = Incomplete::find($incomplete->id);

        $this->assertEquals($incompleteToSave->text, $incompleteU->text);
    }

    public function test_delete_a_incomplete()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $incomplete1 = Incomplete::factory()
                    ->for($book)
                    ->create();

        $incomplete2 = Incomplete::factory()
                    ->for($book)
                    ->create();

        $incompleteService = $this->incompleteServiceSetup();

        $incompleteService->deleteincomplete($incomplete1->id);

        $bookU = Book::find($book->id);

        $this->assertEquals(1, $bookU->incompletes()->count());
    }

    public function test_filter_incompletes()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $incompletes = Incomplete::factory()
                    ->for($book)
                    ->count(4)
                    ->create();

        $incomplete = Incomplete::where('book_id', $book->id)->first();

        $incompleteService = $this->incompleteServiceSetup();

        $filterincompletes = $incompleteService->filterincompletes('', $book->id);

        $this->assertEquals(4,count($filterincompletes));

        $filterincompletes = $incompleteService->filterincompletes('', $book->id);

        $this->assertEquals(4,count($filterincompletes));

        $filterincompletes = $incompleteService->filterincompletes($incomplete->text, $book->id);

        $this->assertEquals(1,count($filterincompletes));
    }

    private function incompleteServiceSetup(): incompleteService
    {
        $incompleteRepository = new IncompleteRepository();
        $incompleteService = new IncompleteService($incompleteRepository);
        return $incompleteService;
    }


}
