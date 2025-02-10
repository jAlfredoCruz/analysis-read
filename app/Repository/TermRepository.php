<?php

namespace App\Repository;

use App\Interfaces\Repositories\ITermRepository;
use App\Models\Term;
use Illuminate\Pagination\LengthAwarePaginator;

class TermRepository implements ITermRepository {

    public function create(Term $newTerm): Term {

       $term = new Term();
       $term->name = $newTerm->name;
       $term->definition = $newTerm->definition;
       $term->book_id = $newTerm->book_id;
       $term->save();

       return $term;
    }

    public function findTermsByBook(int $bookId, int $paginate): LengthAwarePaginator {
        return Term::where('book_id', $bookId)->paginate($paginate);
    }

    public function update(int $termId, Term $newTerm): Term
    {

       $term = Term::find($termId);
       $term->name = $newTerm->name;
       $term->definition = $newTerm->definition;
       $term->book_id = $term->book_id;
       $term->save();

       return $term;
    }

    public function delete(int $termId): void
    {
        $term = Term::find($termId);
        $term->delete();
    }

    public function findTermsLikeNameAndByBook(string $name, int $bookId, int $paginate): LengthAwarePaginator
    {
        return Term::where('book_id', $bookId)
                ->where('name', 'like', "%$name%")
                ->paginate($paginate);
    }
}
