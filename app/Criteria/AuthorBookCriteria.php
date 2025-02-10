<?php

namespace App\Criteria;

use Baethon\LaravelCriteria\CriteriaInterface;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Str;

class AuthorBookCriteria implements CriteriaInterface
{
    private array $booksIds;

    public function __construct(array $booksIds)
    {
        $this->booksIds = $booksIds;
    }

    public function apply($query)
    {
       /* $query
        ->filter(function(Book $book) {
            return $book->authors->contains(function(Author $author) {
                return  Str::contains(strtolower($author->name),strtolower($this->name));
            });
        }); **/
        $query->whereIn('id', $this->booksIds);
    }
}
