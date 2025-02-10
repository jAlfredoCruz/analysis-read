@extends('layouts.manager', ['book' => $book])

@section('content')
<h1 class="text-center font-sans font-bold text-2xl ">Primer nivel</h1>
<p class="text-lg font-mono">Existen 4 etapas para el aprendizaje de la lectura:</p>
<ol class="text-lg font-mono">
    <li>
        <h2 class="text-center font-bold text-xl" >Etapa 1</h2>
        <p class="text-lg font-mono"> Se trata de tener las condiciones físicas y mentales para empezar a leer, que se valora mediante pruebas o las estimaciones de los profesores.</p>
    </li>
    <li>
        <h2 class="text-center font-bold text-xl" >Etapa 2</h2>
        <p class="text-lg font-mono">Se introducen las destrezas básicas, como la utilización de claves de contexto o de significación y los sonidos iniciales de las palabras. Al finalizar este periodo, los alumnos deben ser capaces de leer libros sencillos.</p>
    </li>
    <li>
        <h2 class="text-center font-bold text-xl" >Etapa 3</h2>
        <p class="text-lg font-mono">Obtiene una creciente destreza para desvelar el significado de palabras desconocidas mediante claves de contexto.</p>
    </li>
    <li>
        <h2 class="text-center font-bold text-xl" >Etapa 4</h2>
        <p class="text-lg font-mono">Traslada conceptos de un texto a otro y a comparar los puntos de vista de distintos escritores sobre el mismo tema.</p>
    </li>
</ol>
@endsection
