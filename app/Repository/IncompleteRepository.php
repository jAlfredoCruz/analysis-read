<?php

namespace App\Repository;

use App\Interfaces\Repositories\IIncompleteRepository;
use App\Models\Incomplete;
use Illuminate\Pagination\LengthAwarePaginator;

class IncompleteRepository implements IIncompleteRepository {

    public function create(Incomplete $newIncomplete): Incomplete {

       $incomplete = new Incomplete();
       $incomplete->text = $newIncomplete->text;
       $incomplete->book_id = $newIncomplete->book_id;
       $incomplete->save();

       return $incomplete;
    }

    public function findIncompletesByBook(int $bookId, int $paginate): LengthAwarePaginator {
        return Incomplete::where('book_id', $bookId)->paginate($paginate);
    }

    public function update(int $incompleteId, Incomplete $newIncomplete): Incomplete
    {

       $incomplete = Incomplete::find($incompleteId);
       $incomplete->text = $newIncomplete->text;
       $incomplete->save();

       return $incomplete;
    }

    public function delete(int $incompleteId): void
    {
        $incomplete = Incomplete::find($incompleteId);
        $incomplete->delete();
    }

    public function findIncompletesLikeTextAndByBook(string $text, int $bookId, int $paginate): LengthAwarePaginator
    {
        return Incomplete::where('book_id', $bookId)
                ->where('text', 'like', "%$text%")
                ->paginate($paginate);
    }
}
