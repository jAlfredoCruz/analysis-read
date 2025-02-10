<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Term;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Service\TermService;
use App\Repository\TermRepository;

class TermServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_a_term()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $term = Term::factory()
                    ->for($book)
                    ->make();

        $termService = $this->termServiceSetup();

        $termService->saveTerm($term);

        $this->assertDatabaseHas('terms', [
            'book_id' => $book->id,
            'name' => $term->name,
            'definition' => $term->definition
        ]);

        $bookUpdated = Book::find($book->id);
        $termU = Term::where('book_id', $book->id)->first();

        $this->assertEquals(1, $bookUpdated->terms()->count());
        $this->assertEquals($term->name, $termU->name);
        $this->assertEquals($term->definition, $termU->definition);
    }

    public function test_update_a_term()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $term = Term::factory()
                    ->for($book)
                    ->create();

        $termToSave = Term::factory()
                ->for($book)
                ->make();

        $termService = $this->termServiceSetup();

        $termService->updateTerm($term->id, $termToSave);

        $termU = Term::find($term->id);

        $this->assertEquals($termToSave->name, $termU->name);
        $this->assertEquals($termToSave->definition, $termU->definition);
    }

    public function test_delete_a_term()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $term1 = Term::factory()
                    ->for($book)
                    ->create();

        $term2 = Term::factory()
                    ->for($book)
                    ->create();

        $termService = $this->termServiceSetup();

        $termService->deleteTerm($term1->id);

        $bookU = Book::find($book->id);

        $this->assertEquals(1, $bookU->terms()->count());
    }

    public function test_filter_terms()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $terms = Term::factory()
                    ->for($book)
                    ->count(4)
                    ->create();

        $term = Term::where('book_id', $book->id)->first();

        $termService = $this->termServiceSetup();

        $filterTerms = $termService->filterTerms('', $book->id);

        $this->assertEquals(4,count($filterTerms));

        $filterTerms = $termService->filterTerms('', $book->id);

        $this->assertEquals(4,count($filterTerms));

        $filterTerms = $termService->filterTerms($term->name, $book->id);

        $this->assertEquals(1,count($filterTerms));

    }

    private function termServiceSetup(): TermService
    {
        $termRepository = new TermRepository();
        $termService = new TermService($termRepository);
        return $termService;
    }
}
