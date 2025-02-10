<?php

namespace App\Repository;

use App\Interfaces\Repositories\IAuthorRepository;
use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class AuthorRepository implements IAuthorRepository {

    public function save(Author $author, int $userId): Author{

        $newAuthor = new Author();
        $newAuthor->name = $author->name;
        $newAuthor->user_id = $userId;
        $newAuthor->save();

        return $newAuthor;
    }

    public function saveAll(array $authors, int $userId): Collection
    {

        $user = User::findOrFail($userId);
        return $user->authors()->createMany($authors);
    }

    public function findAuthorsByUserId(int $userId): Collection
    {
        return User::findOrFail($userId)->authors;
    }

    public function findAuthorByName(string $name): Author
    {
        return Author::where('name', $name)->first();
    }

    public function existsByName(string $name): bool
    {
        return Author::where('name', $name)->exists();
    }

    public function update(string $name, int $authorId): Author
    {
        $author = Author::findOrFail($authorId);
        $author->name = $name;
        $author->save();

        return $author;
    }

    public function delete(int $authorId): void
    {
        $author = Author::findOrFail($authorId);
        $author->delete();
    }

    public function findAuthorById(int $auhtorId): Author
    {
        return Author::findorFail($auhtorId);
    }

    public function findAuthorsIdsLikeName($name, int $userId): array
    {
        return Author::where('name','like', '%'. $name. '%')
            ->where('user_id', $userId)
            ->pluck('id')
            ->toArray();
    }

    public function getAuthorName(int $authorId): string
    {
       $author = Author::findorFail($authorId);
       return $author->name;
    }
}
