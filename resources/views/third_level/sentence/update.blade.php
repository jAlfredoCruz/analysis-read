@extends('layouts.manager', ['book' => $book])

@section('content')
 <livewire:sentence.form-sentence :book="$book" :sentence="$sentence" />
@endsection
