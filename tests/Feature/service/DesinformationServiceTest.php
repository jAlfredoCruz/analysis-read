<?php

namespace Tests\Feature\service;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Desinformation;
use App\Repository\DesinformationRepository;
use App\Service\DesinformationService;

class DesinformationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_a_desinformation()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $desinformation = Desinformation::factory()
                    ->for($book)
                    ->make();

        $desinformationService = $this->desinformationServiceSetup();

        $desinformationService->saveDesinformation($desinformation);

        $this->assertDatabaseHas('Desinformations', [
            'book_id' => $book->id,
            'text' => $desinformation->text
        ]);

        $bookUpdated = Book::find($book->id);
        $desinformationU = Desinformation::where('book_id', $book->id)->first();

        $this->assertEquals(1, $bookUpdated->desinformations()->count());
        $this->assertEquals($desinformation->text, $desinformationU->text);
    }

    public function test_update_a_desinformation()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $desinformation = Desinformation::factory()
                    ->for($book)
                    ->create();

        $desinformationToSave = Desinformation::factory()
                ->for($book)
                ->make();

        $desinformationService = $this->desinformationServiceSetup();

        $desinformationService->updateDesinformation($desinformation->id, $desinformationToSave);

        $desinformationU = Desinformation::find($desinformation->id);

        $this->assertEquals($desinformationToSave->text, $desinformationU->text);
    }

    public function test_delete_a_desinformation()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $desinformation1 = Desinformation::factory()
                    ->for($book)
                    ->create();

        $desinformation2 = Desinformation::factory()
                    ->for($book)
                    ->create();

        $desinformationService = $this->desinformationServiceSetup();

        $desinformationService->deleteDesinformation($desinformation1->id);

        $bookU = Book::find($book->id);

        $this->assertEquals(1, $bookU->desinformations()->count());
    }

    public function test_filter_desinformations()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $desinformations = Desinformation::factory()
                    ->for($book)
                    ->count(4)
                    ->create();

        $desinformation = Desinformation::where('book_id', $book->id)->first();

        $desinformationService = $this->desinformationServiceSetup();

        $filterDesinformations = $desinformationService->filterDesinformations('', $book->id);

        $this->assertEquals(4,count($filterDesinformations));

        $filterDesinformations = $desinformationService->filterDesinformations('', $book->id);

        $this->assertEquals(4,count($filterDesinformations));

        $filterDesinformations = $desinformationService->filterDesinformations($desinformation->text, $book->id);

        $this->assertEquals(1,count($filterDesinformations));
    }

    private function desinformationServiceSetup(): DesinformationService
    {
        $desinformationRepository = new DesinformationRepository();
        $desinformationService = new DesinformationService($desinformationRepository);
        return $desinformationService;
    }
}
