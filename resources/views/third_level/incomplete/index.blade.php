@extends('layouts.manager', ['book' => $book])

@section('content')
 <livewire:incomplete.incompletes :book="$book" />
@endsection
