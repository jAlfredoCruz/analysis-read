@extends('layouts.manager', ['book' => $book])

@section('content')
<livewire:problem.form-problem :problem="$problem" :book="$book" />
@endsection
