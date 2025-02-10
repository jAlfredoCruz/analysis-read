@extends('layouts.manager', ['book' => $book])

@section('content')
<h1 class="text-2xl text-center font-bold">Preguntas que se deben tener en cuenta al momento de leer</h1>
<livewire:second_level.question :book="$book" :question="$question"/>
@endsection
