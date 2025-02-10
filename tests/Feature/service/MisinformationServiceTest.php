<?php

namespace Tests\Feature\service;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Misinformation;
use App\Repository\MisinformationRepository;
use App\Service\MisinformationService;

class MisinformationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_a_misinformation()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $misinformation = Misinformation::factory()
                    ->for($book)
                    ->make();

        $misinformationService = $this->misinformationServiceSetup();

        $misinformationService->saveMisinformation($misinformation);

        $this->assertDatabaseHas('Misinformations', [
            'book_id' => $book->id,
            'text' => $misinformation->text
        ]);

        $bookUpdated = Book::find($book->id);
        $misinformationU = Misinformation::where('book_id', $book->id)->first();

        $this->assertEquals(1, $bookUpdated->misinformations()->count());
        $this->assertEquals($misinformation->text, $misinformationU->text);
    }

    public function test_update_a_misinformation()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $misinformation = Misinformation::factory()
                    ->for($book)
                    ->create();

        $misinformationToSave = Misinformation::factory()
                ->for($book)
                ->make();

        $misinformationService = $this->misinformationServiceSetup();

        $misinformationService->updateMisinformation($misinformation->id, $misinformationToSave);

        $misinformationU = Misinformation::find($misinformation->id);

        $this->assertEquals($misinformationToSave->text, $misinformationU->text);
    }

    public function test_delete_a_misinformation()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $misinformation1 = Misinformation::factory()
                    ->for($book)
                    ->create();

        $misinformation2 = Misinformation::factory()
                    ->for($book)
                    ->create();

        $misinformationService = $this->misinformationServiceSetup();

        $misinformationService->deleteMisinformation($misinformation1->id);

        $bookU = Book::find($book->id);

        $this->assertEquals(1, $bookU->misinformations()->count());
    }

    public function test_filter_misinformations()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $misinformations = Misinformation::factory()
                    ->for($book)
                    ->count(4)
                    ->create();

        $misinformation = Misinformation::where('book_id', $book->id)->first();

        $misinformationService = $this->misinformationServiceSetup();

        $filterMisinformations = $misinformationService->filterMisinformations('', $book->id);

        $this->assertEquals(4,count($filterMisinformations));

        $filterMisinformations = $misinformationService->filterMisinformations('', $book->id);

        $this->assertEquals(4,count($filterMisinformations));

        $filterMisinformations = $misinformationService->filterMisinformations($misinformation->text, $book->id);

        $this->assertEquals(1,count($filterMisinformations));
    }

    private function misinformationServiceSetup(): MisinformationService
    {
        $misinformationRepository = new MisinformationRepository();
        $misinformationService = new MisinformationService($misinformationRepository);
        return $misinformationService;
    }
}

