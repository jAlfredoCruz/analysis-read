@extends('layouts.manager', ['book' => $book])

@section('content')
<livewire:problem.read-problem :problem="$problem" :book="$book" />
@endsection
