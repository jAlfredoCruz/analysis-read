<?php

namespace App\Repository;

use App\Interfaces\Repositories\IIlogicRepository;
use App\Models\Ilogic;
use Illuminate\Pagination\LengthAwarePaginator;

class IlogicRepository implements IIlogicRepository {

    public function create(Ilogic $newIlogic): Ilogic {

       $ilogic = new Ilogic();
       $ilogic->text = $newIlogic->text;
       $ilogic->book_id = $newIlogic->book_id;
       $ilogic->save();

       return $ilogic;
    }

    public function findIlogicsByBook(int $bookId, int $paginate): LengthAwarePaginator {
        return Ilogic::where('book_id', $bookId)->paginate($paginate);
    }

    public function update(int $ilogicId, Ilogic $newIlogic): Ilogic
    {

       $ilogic = Ilogic::find($ilogicId);
       $ilogic->text = $newIlogic->text;
       $ilogic->save();

       return $ilogic;
    }

    public function delete(int $ilogicId): void
    {
        $ilogic = Ilogic::find($ilogicId);
        $ilogic->delete();
    }

    public function findIlogicsLikeTextAndByBook(string $text, int $bookId, int $paginate): LengthAwarePaginator
    {
        return Ilogic::where('book_id', $bookId)
                ->where('text', 'like', "%$text%")
                ->paginate($paginate);
    }
}
