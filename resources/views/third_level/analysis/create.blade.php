@extends('layouts.manager', ['book' => $book])

@section('content')
<livewire:analysis.form-analysis :book="$book" />
@endsection
