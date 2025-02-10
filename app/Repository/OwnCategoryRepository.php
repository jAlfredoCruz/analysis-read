<?php

namespace App\Repository;

use App\Interfaces\Repositories\IOwnCategoryRepository;
use App\Models\MyOwnCategory;
use Illuminate\Database\Eloquent\Collection;

class OwnCategoryRepository implements IOwnCategoryRepository
{
    public function save(MyOwnCategory $myCategory): MyOwnCategory
    {
        $category = new MyOwnCategory();
        $category->name = $myCategory->name;
        $category->user_id = $myCategory->user_id;
        $category->save();

        return $category;
    }

    public function update(string $name, int $categoryId): MyOwnCategory
    {
        $category = MyOwnCategory::find($categoryId);
        $category->name = $name;
        $category->save();

        return $category;
    }

    public function findCategoriesByUserId(int $userId): Collection
    {
        $categories = MyOwnCategory::where('user_id', $userId)->get();

        return $categories;
    }

    public function delete(int $categoryId): void
    {
        $category = MyOwnCategory::find($categoryId);
        $category->delete();
    }

    public function findMyOwnCategoryById(int $categoryId): MyOwnCategory
    {
        $category = MyOwnCategory::findOrFail($categoryId);
        return $category;
    }

    public function findMyOwnCategoryLikeName(int $userId, string $name): Collection
    {
        return MyOwnCategory::where('user_id', $userId)
            ->where('name', 'like', '%' . $name . '%')
            ->get();
    }
}
