<?php

namespace App\Interfaces\Repositories;

use App\Models\Perfil;
use Illuminate\Database\Eloquent\Collection;

interface IPerfilRepository
{
    public function create(Perfil $perfil): Perfil;
    public function delete(int $perfilId): void;
    public function findById(int $id): Perfil;
    public function findLikeNameAndLevel(string $name, string $level, int $bookId): Collection;
    public function findPerfilsByBook(int $bookId): Collection;
    public function findLevelsByBook(int $bookId): Collection;
    public function update(int $perfilId, Perfil $perfil): Perfil;
    public function findNumberOfSublevelInPerfil(string $level, int $perfilId): int;
}
