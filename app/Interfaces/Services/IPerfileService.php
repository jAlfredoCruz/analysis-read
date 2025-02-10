<?php

namespace App\Interfaces\Services;


use App\Models\Perfil;
use Illuminate\Database\Eloquent\Collection;

interface IPerfileService
{
    public function savePerfil(Perfil $perfil): bool;
    public function updatePerfil(int $perfilId, Perfil $perfil): bool;
    public function deletePerfil(int $perfilId);
    public function getPerfil(int $perfilId): Perfil;
    public function getPerfilsByBook(int $bookId): Collection;
    public function getLevelsByBook(int $bookId): Collection;
    public function filterPerfils(string $search, Collection $perfils, int $bookId): Collection;
    public function hasSublevels(Perfil $perfil): bool;
}
