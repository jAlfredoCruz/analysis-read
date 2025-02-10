@extends('layouts.manager', ['book' => $book])

@section('content')
<livewire:problem.form-answer :problem="$problem" :book="$book"  />
@endsection
