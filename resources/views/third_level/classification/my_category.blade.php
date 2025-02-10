@extends('layouts.manager', ['book' => $book])

@section('content')
<h1 class="font-mono text-2xl font-bold text-center">Crea tus categorias</h1>
<livewire:classification.category-table />
@endsection
