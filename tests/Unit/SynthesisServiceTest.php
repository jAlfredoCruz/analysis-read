<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Synthesis;
use App\Repository\SynthesisRepository;
use App\Service\SynthesisService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SynthesisServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_synthesis_save()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $synthesisService = $this->synthesisServiceSetup();

        $synthesisService->saveSynthesis($book->id, 'Test Synthesis');

        $bookUpdate = Book::find($book->id);
        $newSynthesis = Synthesis::where('book_id', $book->id)->first()->text;

        $this->assertEquals('Test Synthesis', $bookUpdate->synthesis->text);
        $this->assertEquals('Test Synthesis', $newSynthesis);

    }

    public function test_synthesis_update()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'Test Book'
            ]);

        $synthesis = Synthesis::factory()
            ->for($book)
            ->create([
                'text' => 'Test Synthesis'
            ]);

        $synthesisService = $this->synthesisServiceSetup();

        $synthesisService->updateSynthesis($synthesis->id, 'Updated Synthesis');

        $bookUpdate = Book::find($book->id);
        $newSynthesis = Synthesis::where('book_id', $book->id)->first()->text;

        $this->assertEquals('Updated Synthesis', $bookUpdate->synthesis->text);
        $this->assertEquals('Updated Synthesis', $newSynthesis);

    }

    public function test_synthesis_exist()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'Test Book'
            ]);

        $synthesis = Synthesis::factory()
            ->for($book)
            ->create([
                'text' => 'Test Synthesis'
            ]);

        $synthesisService = $this->synthesisServiceSetup();

        $synthesis = $synthesisService->existSynthesisBook($book->id);

        $this->assertEquals(true, $synthesis);
    }

    public function test_synthesis_doesnt_exist()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'Test Book'
            ]);


        $synthesisService = $this->synthesisServiceSetup();

        $synthesis = $synthesisService->existSynthesisBook($book->id);

        $this->assertEquals(false, $synthesis);
    }

    private function synthesisServiceSetup(): SynthesisService
    {
        $synthesisRepository = new SynthesisRepository();
        $synthesisService = new SynthesisService($synthesisRepository);
        return $synthesisService;
    }

}
