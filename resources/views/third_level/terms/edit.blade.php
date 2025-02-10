@extends('layouts.manager', ['book' => $book])

@section('content')
    <livewire:terms.form-term :term="$term" :book="$book" />
@endsection
