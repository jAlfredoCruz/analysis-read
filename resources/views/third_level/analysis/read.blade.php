@extends('layouts.manager', ['book' => $book])

@section('content')
<livewire:analysis.read-analysis :perfil="$perfil" :book="$book" />
@endsection
