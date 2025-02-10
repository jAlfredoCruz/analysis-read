@extends('layouts.manager', ['book' => $book])

@section('content')
<livewire:analysis.analysis :book="$book" />
@endsection
