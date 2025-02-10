<?php

namespace App\Interfaces\Repositories;

use App\Models\MyOwnCategory;
use Illuminate\Database\Eloquent\Collection;

interface IOwnCategoryRepository {
    public function save(MyOwnCategory $category): MyOwnCategory;
    public function findCategoriesByUserId(int $userId): Collection;
    public function update(string $name, int $categoryId): MyOwnCategory;
    public function delete(int $categoryId): void;
    public function findMyOwnCategoryById(int $categoryId): MyOwnCategory;
    public function findMyOwnCategoryLikeName(int $userId, string $categoryName): Collection;

}
