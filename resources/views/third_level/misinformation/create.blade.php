@extends('layouts.manager', ['book' => $book])

@section('content')
    <livewire:misinformation.form-misinformation  :book="$book" />
@endsection
