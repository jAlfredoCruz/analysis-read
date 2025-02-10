@extends('layouts.manager', ['book' => $book])

@section('content')
<livewire:terms.term-definition :book="$book" />
@endsection
