<?php

namespace App\Repository;

use App\Interfaces\Repositories\IMisinformationRepository;
use App\Models\Misinformation;
use Illuminate\Pagination\LengthAwarePaginator;

class MisinformationRepository implements IMisinformationRepository {

    public function create(Misinformation $newMisinformation): Misinformation {

       $misinformation = new Misinformation();
       $misinformation->text = $newMisinformation->text;
       $misinformation->book_id = $newMisinformation->book_id;
       $misinformation->save();

       return $misinformation;
    }

    public function findMisinformationsByBook(int $bookId, int $paginate): LengthAwarePaginator {
        return Misinformation::where('book_id', $bookId)->paginate($paginate);
    }

    public function update(int $misinformationId, Misinformation $newMisinformation): Misinformation
    {

       $misinformation = Misinformation::find($misinformationId);
       $misinformation->text = $newMisinformation->text;
       $misinformation->save();

       return $misinformation;
    }

    public function delete(int $misinformationId): void
    {
        $misinformation = Misinformation::find($misinformationId);
        $misinformation->delete();
    }

    public function findMisinformationsLikeTextAndByBook(string $text, int $bookId, int $paginate): LengthAwarePaginator
    {
        return Misinformation::where('book_id', $bookId)
                ->where('text', 'like', "%$text%")
                ->paginate($paginate);
    }
}
