<?php

namespace App\Repository;

use App\Interfaces\Repositories\IDesinformationRepository;
use App\Models\Desinformation;
use Illuminate\Pagination\LengthAwarePaginator;

class DesinformationRepository implements IDesinformationRepository {

    public function create(Desinformation $newDesinformation): Desinformation {

       $desinformation = new Desinformation();
       $desinformation->text = $newDesinformation->text;
       $desinformation->book_id = $newDesinformation->book_id;
       $desinformation->save();

       return $desinformation;
    }

    public function findDesinformationsByBook(int $bookId, int $paginate): LengthAwarePaginator {
        return Desinformation::where('book_id', $bookId)->paginate($paginate);
    }

    public function update(int $desinformationId, Desinformation $newDesinformation): Desinformation
    {

       $desinformation = Desinformation::find($desinformationId);
       $desinformation->text = $newDesinformation->text;
       $desinformation->save();

       return $desinformation;
    }

    public function delete(int $desinformationId): void
    {
        $desinformation = Desinformation::find($desinformationId);
        $desinformation->delete();
    }

    public function findDesinformationsLikeTextAndByBook(string $text, int $bookId, int $paginate): LengthAwarePaginator
    {
        return Desinformation::where('book_id', $bookId)
                ->where('text', 'like', "%$text%")
                ->paginate($paginate);
    }
}
