@extends('layouts.manager', ['book' => $book])

@section('content')
<div>
    <h1 class="font-mono text-2xl font-bold text-center">Regla 1</h1>
    <p class="font-mono text-xl font-semibold">HAY QUE SABER QUE CLASE DE LIBRO SE ESTA LEYENDO LO MAS PRONTO POSIBLE EN EL PROCESO DE LECTURA, PREFERIBLEMENTE ANTES DE EMPEZAR</p>
    <livewire:classification.classification :book="$book" ></livewire:classification.classification>
</div>
@endsection
