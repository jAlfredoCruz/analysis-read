<?php

namespace App\Interfaces\Repositories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;

interface IAuthorRepository {

    public function save(Author $author, int $userId): Author;
    public function saveAll(array $authors, int $userId): Collection;
    public function findAuthorsByUserId(int $userId): Collection;
    public function findAuthorByName(string $name): Author;
    public function findAuthorById(int $authorId): Author;
    public function findAuthorsIdsLikeName($name, int $userId): array;
    public function existsByName(string $name): bool;
    public function update(string $name, int $authorId): Author;
    public function delete(int $authorId): void;
    public function getAuthorName(int $authorId): string;
}
