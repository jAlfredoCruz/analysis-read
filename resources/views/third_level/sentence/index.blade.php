@extends('layouts.manager', ['book' => $book])

@section('content')
 <livewire:sentence.sentences :book="$book" />
@endsection
