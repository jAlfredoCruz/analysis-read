<?php

namespace Tests\Feature\service;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Sentence;
use App\Models\User;
use App\Repository\SentenceRepository;
use App\Service\SentenceService;

class SentenceServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_a_sentence()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $sentence = Sentence::factory()
                    ->for($book)
                    ->make();

        $sentenceService = $this->SentenceServiceSetup();

        $sentenceService->saveSentence($sentence);

        $this->assertDatabaseHas('sentences', [
            'book_id' => $book->id,
            'text' => $sentence->text
        ]);

        $bookUpdated = Book::find($book->id);
        $sentenceU = Sentence::where('book_id', $book->id)->first();

        $this->assertEquals(1, $bookUpdated->sentences()->count());
        $this->assertEquals($sentence->text, $sentenceU->text);
    }

    public function test_update_a_sentence()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $sentence = Sentence::factory()
                    ->for($book)
                    ->create();

        $sentenceToSave = Sentence::factory()
                ->for($book)
                ->make();

        $sentenceService = $this->sentenceServiceSetup();

        $sentenceService->updateSentence($sentence->id, $sentenceToSave);

        $sentenceU = Sentence::find($sentence->id);

        $this->assertEquals($sentenceToSave->text, $sentenceU->text);
    }

    public function test_delete_a_sentence()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $sentence1 = Sentence::factory()
                    ->for($book)
                    ->create();

        $sentence2 = Sentence::factory()
                    ->for($book)
                    ->create();

        $sentenceService = $this->sentenceServiceSetup();

        $sentenceService->deleteSentence($sentence1->id);

        $bookU = Book::find($book->id);

        $this->assertEquals(1, $bookU->sentences()->count());
    }

    public function test_filter_Sentences()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $sentences = Sentence::factory()
                    ->for($book)
                    ->count(4)
                    ->create();

        $sentence = Sentence::where('book_id', $book->id)->first();

        $sentenceService = $this->sentenceServiceSetup();

        $filterSentences = $sentenceService->filterSentences('', $book->id);

        $this->assertEquals(4,count($filterSentences));

        $filterSentences = $sentenceService->filterSentences('', $book->id);

        $this->assertEquals(4,count($filterSentences));

        $filterSentences = $sentenceService->filterSentences($sentence->text, $book->id);

        $this->assertEquals(1,count($filterSentences));

    }

    private function sentenceServiceSetup(): SentenceService
    {
        $sentenceRepository = new SentenceRepository();
        $sentenceService = new SentenceService($sentenceRepository);
        return $sentenceService;
    }
}
