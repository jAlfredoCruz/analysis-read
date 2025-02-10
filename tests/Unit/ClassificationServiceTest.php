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
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repository\ClassificationRepository;
use App\Service\ClassificationService;
use App\Repository\OwnCategoryRepository;

class ClassificationServiceTest extends TestCase
{

    use RefreshDatabase;

    // Successfully saves book type for valid book ID and type string
    public function test_save_book_type_success()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'Test Book'
            ]);

        $classificationService = $this->setupClassiicationService();

        $classificationService->saveBookType($book->id, Type::PRACTICAL->toString());

        $bookUpdated = Book::find($book->id);

        $this->assertEquals(Type::PRACTICAL->toString(), $bookUpdated->type);

    }

    public function test_save_book_proposal_success()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'Test Book'
            ]);

        $classificationService = $this->setupClassiicationService();

        $classificationService->saveBookProposalCategory($book->id, Proposed::PRACTICAL->toString());

        $bookUpdated = Book::find($book->id);

        $this->assertEquals(Proposed::PRACTICAL->toString(), $bookUpdated->proposal);

    }

    public function test_save_a_book_with_my_own_category()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'Test Book'
            ]);

        $myCategories = MyOwnCategory::factory()->count(3)->create();
        $myCategory = $myCategories->first();

        $classificationService = $this->setupClassiicationService();

        $classificationService->saveBookMyCategory($book->id, $myCategory->id);

        $bookUpdated = Book::find($book->id);

        $this->assertEquals($myCategory->id, $bookUpdated->category->id);
    }

    private function setupClassiicationService(): ClassificationService
    {
        $classificationRepository = new ClassificationRepository();
        $myCategoryRepository = new OwnCategoryRepository();
        return new ClassificationService($classificationRepository,
            $myCategoryRepository);
    }

}
