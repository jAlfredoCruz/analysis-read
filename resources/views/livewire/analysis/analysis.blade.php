<div>
    <h1 class="font-mono text-2xl font-bold text-center">Regla 3</h1>
    <p class="font-mono text-xl font-semibold">EXPONER LAS PARTES MAS IMPORTANTES DEL LIBRO Y MOSTRAR QUE ESTAN ORGANIZADAS COMO UN TODO, SIGUIENDO UN ORDEN LAS UNAS RESPECTO A LAS OTRAS Y RESPECTO A LA UNIDAD DEL CONJUNTO.</p>
    <div class="flex items-center justify-around mt-8">
        <x-primary-button wire:click='createProfile' >
            Crear analisis
        </x-primary-button>
        <x-primary-button wire:click="openSuggestionModal">
            Sugerencias
        </x-secondary-button>
    </div>
    <div class="flex item-center justify-center m-4">
        <x-input class="block mt-1 w-full" name="search-category" placeholder="search..." wire:model.live='search' />
    </div>
    <div class="mt-2">
        <table>
            @foreach($myPerfils as $perfil)
            <tr>
               {!! $perfil->points() !!}

                <td class="flex items-center justify-center" >
                    <a class="text-sky-700 text-lg  hover:cursor-pointer hover:text-sky-900 font-mono"
                    href="{{ route('read_perfil', ['book' => $book->id, 'perfil' => $perfil->id])}}">
                    {{ $perfil->level}} {{$perfil->name}} </a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <x-dialog-modal id="suggestions" max-width="2xl" wire:model="showSuggestionModal">
        <x-slot:title>Sugerencias</x-slot:title>
        <x-slot:content>
            <p class="text-lg font-mono">a perfilar el libro, es decir a tratar las partes como totalidades subordinadas:</p>
            <ol class="font-mono text-xl list-decimal list-inside">
                <li>El autor ha llevado a cabo su plan en cinco partes fundamentales, la primera de las cuales trata sobre tal y cual cosa
                    <ol class="list-decimal list-inside font-mono text-lg ml-3">
                        <li>La primera de estas partes principales está dividida en tres secciones, la primera de las cuales se ocupa de X
                            <ol class="list-decimal list-inside font-mono text-lg ml-6">
                                <li>En la primera sección de la primera parte el autor establece cuatro puntos, el primero A</li>
                                <li>el segundo B</li>
                                <li>el tercero C</li>
                                <li>el cuarto D </li>
                            </ol>
                        </li>
                        <li>la seunda Y</li>
                        <li>la tercera Z</li>
                    </ol>
                </li>
                <li>la segunda sobre tal y tal tema</li>
                <li>la tercera sobre este otro</li>
                <li>la cuarta sobre tal y cual</li>
                <li>la quinta sobre este otro tema</li>
            </ol>
            <p class="text-lg font-mono"></p>
        </x-slot:content>
        <x-slot:footer>
            <x-secondary-button wire:click="closeSuggestionModal">
                Cerrar
            </x-secondary-button>
        </x-slot:footer>
    </x-dialog-modal>
</div>
