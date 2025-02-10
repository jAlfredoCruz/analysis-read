<?php

namespace Tests\Feature\service;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Argument;
use App\Models\Book;
use App\Models\User;
use App\Repository\ArgumentRepository;
use App\Service\ArgumentService;

class ArgumentServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_an_argument()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $argument = Argument::factory()
                    ->for($book)
                    ->make();

        $argumentService = $this->argumentServiceSetup();

        $argumentService->saveArgument($argument);

        $this->assertDatabaseHas('Arguments', [
            'book_id' => $book->id,
            'text' => $argument->text
        ]);

        $bookUpdated = Book::find($book->id);
        $argumentU = Argument::where('book_id', $book->id)->first();

        $this->assertEquals(1, $bookUpdated->arguments()->count());
        $this->assertEquals($argument->text, $argumentU->text);
    }

    public function test_update_an_argument()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $argument = Argument::factory()
                    ->for($book)
                    ->create();

        $argumentToSave = Argument::factory()
                ->for($book)
                ->make();

        $argumentService = $this->argumentServiceSetup();

        $argumentService->updateArgument($argument->id, $argumentToSave);

        $argumentU = Argument::find($argument->id);

        $this->assertEquals($argumentToSave->text, $argumentU->text);
    }

    public function test_delete_an_argument()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $argument1 = Argument::factory()
                    ->for($book)
                    ->create();

        $argument2 = Argument::factory()
                    ->for($book)
                    ->create();

        $argumentService = $this->argumentServiceSetup();

        $argumentService->deleteArgument($argument1->id);

        $bookU = Book::find($book->id);

        $this->assertEquals(1, $bookU->Arguments()->count());
    }

    public function test_filter_arguments()
    {
        $user = User::factory()->create();

        $book = Book::factory()
            ->for($user)
            ->create();

        $arguments = Argument::factory()
                    ->for($book)
                    ->count(4)
                    ->create();

        $argument = Argument::where('book_id', $book->id)->first();

        $argumentService = $this->argumentServiceSetup();

        $filterArguments = $argumentService->filterArguments('', $book->id);

        $this->assertEquals(4,count($filterArguments));

        $filterArguments = $argumentService->filterArguments('', $book->id);

        $this->assertEquals(4,count($filterArguments));

        $filterArguments = $argumentService->filterArguments($argument->text, $book->id);

        $this->assertEquals(1,count($filterArguments));

    }

    private function argumentServiceSetup(): ArgumentService
    {
        $argumentRepository = new ArgumentRepository();
        $argumentService = new ArgumentService($argumentRepository);
        return $argumentService;
    }
}
