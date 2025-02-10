@extends('layouts.manager', ['book' => $book])

@section('content')
 <livewire:incomplete.form-incomplete :book="$book" />
@endsection
