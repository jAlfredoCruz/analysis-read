<?php

namespace Tests\Feature\service;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Ilogic;
use App\Repository\IlogicRepository;
use App\Service\IlogicService;

class IlogicServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_a_ilogic()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $ilogic = Ilogic::factory()
                    ->for($book)
                    ->make();

        $ilogicService = $this->ilogicServiceSetup();

        $ilogicService->saveIlogic($ilogic);

        $this->assertDatabaseHas('ilogics', [
            'book_id' => $book->id,
            'text' => $ilogic->text
        ]);

        $bookUpdated = Book::find($book->id);
        $ilogicU = Ilogic::where('book_id', $book->id)->first();

        $this->assertEquals(1, $bookUpdated->ilogics()->count());
        $this->assertEquals($ilogic->text, $ilogicU->text);
    }

    public function test_update_a_ilogic()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $ilogic = Ilogic::factory()
                    ->for($book)
                    ->create();

        $ilogicToSave = Ilogic::factory()
                ->for($book)
                ->make();

        $ilogicService = $this->ilogicServiceSetup();

        $ilogicService->updateIlogic($ilogic->id, $ilogicToSave);

        $ilogicU = Ilogic::find($ilogic->id);

        $this->assertEquals($ilogicToSave->text, $ilogicU->text);
    }

    public function test_delete_a_ilogic()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $ilogic1 = Ilogic::factory()
                    ->for($book)
                    ->create();

        $ilogic2 = Ilogic::factory()
                    ->for($book)
                    ->create();

        $ilogicService = $this->ilogicServiceSetup();

        $ilogicService->deleteIlogic($ilogic1->id);

        $bookU = Book::find($book->id);

        $this->assertEquals(1, $bookU->ilogics()->count());
    }

    public function test_filter_ilogics()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $ilogics = Ilogic::factory()
                    ->for($book)
                    ->count(4)
                    ->create();

        $ilogic = Ilogic::where('book_id', $book->id)->first();

        $ilogicService = $this->ilogicServiceSetup();

        $filterIlogics = $ilogicService->filterIlogics('', $book->id);

        $this->assertEquals(4,count($filterIlogics));

        $filterIlogics = $ilogicService->filterIlogics('', $book->id);

        $this->assertEquals(4,count($filterIlogics));

        $filterIlogics = $ilogicService->filterIlogics($ilogic->text, $book->id);

        $this->assertEquals(1,count($filterIlogics));
    }

    private function ilogicServiceSetup(): ilogicService
    {
        $ilogicRepository = new IlogicRepository();
        $ilogicService = new IlogicService($ilogicRepository);
        return $ilogicService;
    }
}
