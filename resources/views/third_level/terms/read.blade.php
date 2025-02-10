@extends('layouts.manager', ['book' => $book])

@section('content')
<h2 class="text-center font-bold text-xl" >{{ $term->name }}</h2>
<p class="text-lg font-mono">{{ $term->definition}}</p>
<div class="flex items-start justify-start">
    <livewire:redirect-button :route="route('term', ['book' => $book->id])"/>
</div>
@endsection
