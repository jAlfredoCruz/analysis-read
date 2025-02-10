@extends('layouts.manager', ['book' => $book])

@section('content')
<p class="text-lg font-mono">{{ $sentence->text }}</p>
<div class="flex items-start justify-start">
    <livewire:redirect-button :route="route('sentence', ['book' => $book->id])" />
</div>
@endsection
