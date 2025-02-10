<?php

namespace App\Repository;

use App\Interfaces\Repositories\IArgumentRepository;
use App\Models\Argument;
use Illuminate\Pagination\LengthAwarePaginator;

class ArgumentRepository implements IArgumentRepository {

    public function create(Argument $newArgument): Argument {

       $argument = new Argument();
       $argument->text = $newArgument->text;
       $argument->book_id = $newArgument->book_id;
       $argument->save();

       return $argument;
    }

    public function findArgumentsByBook(int $bookId, int $paginate): LengthAwarePaginator {
        return Argument::where('book_id', $bookId)->paginate($paginate);
    }

    public function update(int $argumentId, Argument $newArgument): Argument
    {

       $argument = Argument::find($argumentId);
       $argument->text = $newArgument->text;
       $argument->save();

       return $argument;
    }

    public function delete(int $argumentId): void
    {
        $argument = Argument::find($argumentId);
        $argument->delete();
    }

    public function findArgumentsLikeTextAndByBook(string $text, int $bookId, int $paginate): LengthAwarePaginator
    {
        return Argument::where('book_id', $bookId)
                ->where('text', 'like', "%$text%")
                ->paginate($paginate);
    }
}
