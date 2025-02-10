@extends('layouts.manager', ['book' => $book])

@section('content')
    <livewire:desinformation.form-desinformation :book="$book" />
@endsection
