@extends('layouts.manager', ['book' => $book])

@section('content')
<livewire:problem.form-problem :book="$book" />
@endsection
