<div>
    @foreach($books as $book)
    <livewire:book.book-card :book="$book"  :key="$book->id" />
    @endforeach
</div>
