@extends('layouts.manager', ['book' => $book])

@section('content')
<h1 class="font-mono text-2xl font-bold text-center">Lectura superficial</h1>
<h2 class="font-mono text-xl font-bold">Sugerencias</h2>
<ul class="font-mono text-lg list-disc">
    <li>
        <p>
            El problema de la comprensión: No existe ningún curso de lectura rápida que no asegure que puede incrementar la comprensión al mismo tiempo que la velocidad y, en lineas generales es posible que esta afirmación tenga cierto fundamento. Pero la concentración no ejerce demasiada influencia sobre la comprensión tomada en su sentido mas apropiada.
        </p>
    </li>
    <li>
        <p>
            Al enfrentarse por primera vez a un libro difícil, debe leerse entero sin detenerse a buscar las cosas que no se entienden inmediatamente o a reflexionar sobre ellas.
        </p>
    </li>
    <li>
        <p>
            Sobre las velocidades de lectura: Todo libro debe leerse a una velocidad no inferior a la que se merece y no superior a la que puede alcanzar el lector para su satisfacción.
        </p>
    </li>
    <li>
        <p>
            Fijaciones y correcciones: Es uno de los problemas mas recurrentes de los lectores y como se puede corregir con cursos de lectura rápida junto con la técnica de seguimiento con el dedo.
        </p>
    </li>
</ul>
<h2 class="font-mono text-xl font-bold">Preguntas que debes proguntarte al momento de leer</h2>
<ul class="font-mono text-lg list-disc">
    <li>
        <a class="decoration-solid decoration-sky-600 hover:decoration-sky-800 hover:cursor-pointer"
        href="{{ route('question', ['question' => 1, 'book' => $book->id]) }}">¿De que trata el libro como un todo?</a>
    </li>
    <li><a class="decoration-solid decoration-sky-600 hover:decoration-sky-800 hover:cursor-pointer"  href="{{ route('question', ['question' => 2, 'book' => $book->id]) }}">¿Que dice el libro en detalle y como lo dice?</a></li>
    <li>
        <a class="decoration-solid decoration-sky-600 hover:decoration-sky-800 hover:cursor-pointer"  href="{{ route('question', ['question' => 3, 'book' => $book->id]) }}">¿Es el libro verdad o solo parcialmente?</a>
    </li>
    <li>
        <a class="decoration-solid decoration-sky-600 hover:decoration-sky-800 hover:cursor-pointer"  href="{{ route('question', ['question' => 4, 'book' => $book->id]) }}">¿Que importancia tiene?</a>
    </li>
</ul>
<h2 class="font-mono text-xl font-bold">Formas de anotar y subrayar un libro</h2>
<ul class="font-mono text-lg list-disc">
    <li>SUBRAYADO: argumentos de mayor fuerza</li>
    <li>ASTERISCOS U OTROS SIGNOS EN EL MARGEN: para destacar los argumentos principales.</li>
    <li>ASTERISCOS U OTROS SIGNOS AL MARGEN: para destacar los puntos más importantes.</li>
    <li>NÚMEROS EN EL MARGEN: para señalar la secuencia de puntos en el argumento.</li>
    <li>NÚMEROS DE OTRAS PAGINAS EN EL MARGEN: para señalar los puntos contrarios a los del autor.</li>
    <li>RODEAR CON UN CIRCULO LAS PALABRAS O FRASES</li>
    <li>ESCRIBIR EN EL MARGEN O EN LA SUPERIO O INFERIOR DE LA PAGINA.</li>
</ul>
<h2 class="font-mono text-xl font-bold">Tipos de notas</h2>
<ul class="font-mono text-lg list-disc">
    <li>
        <p>
            Notas estructurales: Se debe escribir en el índice o en el índice de materias y se deben contestar las siguientes preguntas: ¿Qué clase de libro es? ¿De qué trata en su conjunto? ¿Cuál es el orden estructural y qué sigue el autor para desarrollar su concepción o comprensión del tema?
        </p>
    </li>
    <li>
        <p>
            Notas conceptuales: En el transcurso de lectura de inspección se puede acceder a las ideas del autor acerca del tema que trata; pero a veces ocurre lo contrario, en cuyo caso hay que posponer el enjuiciamiento hasta que se lea el libro más detenidamente, para dar respuesta después por medio de la lectura analítica.
        </p>
    </li>
    <li>
        <p>
            Notas dialécticas: Estas notas son de carácter conceptual si no a páginas de otros libros, consiste en tomar notas sobre la forma de exposición el tema hay que tomarlo en varias hojas aparejas de una estructura de conceptos una ordenación de enunciados y preguntas acerca de un solo tema.
        </p>
    </li>
</ul>
@endsection
