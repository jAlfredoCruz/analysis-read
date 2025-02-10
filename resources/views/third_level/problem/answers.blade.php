@extends('layouts.manager', ['book' => $book])

@section('content')
    <livewire:problem.problems :book="$book" :answer="true" />
@endsection
