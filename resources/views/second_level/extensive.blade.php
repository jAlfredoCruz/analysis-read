@extends('layouts.manager', ['book' => $book])

@section('content')
<div class="">
    <h2 class="text-center font-sans font-bold text-2xl">Lectura extensiva o prelectura</h2>
    <p class="text-lg font-mono font-bold" >¿Cuando tenemos un libro entre manos que hacer?</p>
    <ol class="text-lg font-mono list-decimal">
        <li>Determinar si el libro merece lectura analítica, pero sospecha que si.</li>
        <li>Cuanto con una cantidad de tiempo limitado para averiguarlo</li>
    </ol>
    <p class="text-lg font-mono font-bold" >Nos ayuda a separar la paja del grano. Para esto los siguientes consejos</p>
    <ul class="text-lg font-mono list-disc">
        <li>Descubrir si el libro requiere una lectura mas detenida.</li>
        <li>Nos revelará mucha información sobre el libro, incluso si decidimos no volver a leerlo.</li>
    </ul>
    <p class="text-lg font-mono font-bold">Y para esto se ofrecen las siguientes sugerencias:</p>
    <ol class="text-lg font-mono list-disc">
        <li>MIRAR LA PAGINA DEL TITULO Y SI EL LIBRO LO TIENE EL PROLOGO.</li>
        <li>ESTUDIAR EL INDICE. Como si un mapa de carreteras antes de iniciar un viaje.</li>
        <li>CONSULTAR EL INDICE ALFABÉTICO (si hay). Cuando vean términos que parezcan cruciales, se deben consultar al menos algunos párrafos citados.</li>
        <li>
            LEER LA RESEÑA PUBLICITARIA DE LA EDITORIAL
            <p>Siguiendo estos pasos sera dificil que se desconcentre de la lectura. El lector podría imaginar que es un detective en busca de las pistas o la idea general de un libro, siempre atento a cualquier material que pueda aclararla</p>
        </li>
        <li>CONSULTAR LOS PARRAFOS QUE PARECEN FUNDAMENTALES PARA SU ARGUMENTACIÓN</li>
        <li>DEBEMOS PASAR LAS PAGINAS DETENIÉNDONOS AQUÍ Y ALLÁ, LEYENDO UNO O DOS PÁRRAFOS, A VECES VARIAS PAGINAS SEGUIDAS, PERO NO MAS.</li>
    </ol>
    <hr />
    <p class="text-lg font-mono">Con estos pasos debemos ser capaces de catalogarlo en nuestro catalogo mental del libros para tomarlo como referencia en un futuro si se presenta la ocasión.</p>
</div>
@endsection
