@extends('layouts.manager', ['book' => $book])

@section('content')
    <livewire:misinformation.misinformations :book="$book" />
@endsection
