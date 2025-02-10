<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repository\PerfilRepository;
use App\Models\User;
use App\Models\Book;
use App\Models\Perfil;
use App\Service\PerfilService;

class PerfilSericeTest extends TestCase
{

    use RefreshDatabase;

    public function test_save_a_perfil()
    {
        $user = User::factory()->create();

        $book = Book::factory()
                ->for($user)
                ->create();

        $perfilToSave = Perfil::factory()
                            ->for($book)
                            ->make();

        $perfilService = $this->setupPerfilService();

        $perfilService->savePerfil($perfilToSave);

        $this->assertDatabaseHas('perfils', [
            'name' => $perfilToSave->name,
            'level' => $perfilToSave->level,
            'text' => $perfilToSave->text,
            'book_id' => $perfilToSave->book_id
        ]);

        $bookUpdated = Book::find($book->id);

        $this->assertEquals(1, $bookUpdated->perfils->count());
        $this->assertEquals($perfilToSave->name, $bookUpdated->perfils->first()->name);
    }

    public function test_update_a_perfil()
    {
        $user = User::factory()->create();

        $book = Book::factory()
                ->for($user)
                ->create();
        $perfilToSave = Perfil::factory()
                            ->for($book)
                            ->create();
        $perfilToUpdate = Perfil::factory()
                            ->for($book)
                            ->make();
        $perfilService = $this->setupPerfilService();

        $perfilService->updatePerfil($perfilToSave->id, $perfilToUpdate);

        $this->assertDatabaseHas('perfils', [
            'name' => $perfilToUpdate->name,
            'level' => $perfilToUpdate->level,
            'text' => $perfilToUpdate->text,
            'book_id' => $perfilToUpdate->book_id
        ]);

        $bookUpdated = Book::find($book->id);

        $this->assertEquals(1, $bookUpdated->perfils->count());
        $this->assertEquals($perfilToUpdate->name, $bookUpdated->perfils->first()->name);
    }

    public function test_delete_a_perfil()
    {
        $user = User::factory()->create();

        $book = Book::factory()
                ->for($user)
                ->create();
        $perfil = Perfil::factory()
                            ->for($book)
                            ->create();
        $perfilService = $this->setupPerfilService();

        $perfilService->deletePerfil($perfil->id);

        $this->assertDatabaseMissing('perfils', [
            'name' => $perfil->name,
            'level' => $perfil->level,
            'text' => $perfil->text,
            'book_id' => $perfil->book_id
        ]);

        $bookUpdated = Book::find($book->id);

        $this->assertEquals(0, $bookUpdated->perfils->count());
    }

    public function setupPerfilService(): PerfilService
    {
        $perfilRepository = new PerfilRepository();

        return new PerfilService($perfilRepository);
    }
}
