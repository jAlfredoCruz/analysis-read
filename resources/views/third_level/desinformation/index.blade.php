@extends('layouts.manager', ['book' => $book])

@section('content')
    <livewire:desinformation.desinformations :book="$book" />
@endsection
