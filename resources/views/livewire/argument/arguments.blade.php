
<div>
    <h1 class="font-mono text-2xl font-bold text-center">Regla 7</h1>
    <p class="font-mono text-xl font-semibold">LOCALIZAR LOS ARGUMENTOS BASICOS DEL LIBRO MEDIANTE LA CONEXIÓN DE LAS ORACIONES.</p>
    <h1 class="font-mono text-2xl font-bold text-center mt-2">Regla 7 Bis</h1>
    <p class="font-mono text-xl font-semibold">ENCONTRAR SI SE PUEDE, LOS PARRAFOS DE UN LIBRO QUE ENUNCIEN LOS ARGUMENTOS IMPORTANTES; PERO SI NO ESTAN ASI EXPRESADOS, LA TAREA DEL LECTOR CONSISTE EN CONSTRUIRLOS, TOMANDO UNA ORACION DE ESTE PARRAFO Y OTRA AQUEL, HASTA HABER REUNIDO LA SECUENCIA DE ORACIONES QUE CONSTITUYE EL ARGUMENTO</p>
    <div class="flex items-center justify-around mt-8">
        <x-primary-button wire:click='createArgument'>
            Crear oracion
        </x-primary-button>
        <x-primary-button wire:click="openSuggestionModal">
            Sugerencias
        </x-secondary-button>
    </div>
    <div class="flex item-center justify-center m-4">
        <x-input class="block mt-1 w-full" name="search-category" placeholder="search..." wire:model.live='search' />
    </div>
    <div class="mt-2 flex item-center justify-center">
        @foreach($myArguments as $argument)
            <x-card :id="$argument->id"
                title=""
                :key="$argument->id"
                watch-route="{{ route('read_argument', ['book' => $book->id, 'argument' => $argument->id]) }}"
                edit-route="{{ route('update_argument', ['book' => $book->id, 'argument' => $argument->id]) }}"
                >
                {!! $argument->shortText() !!}
            </x-card>
        @endforeach
        <div>
            {{ $myArguments->links() }}
        </div>
    </div>
    <x-dialog-modal id="suggestions" max-width="2xl" wire:model="showSuggestionModal">
        <x-slot:title>Sugerencias</x-slot:title>
        <x-slot:content>
            <p class="font-mono text-xl">
                La unidad lógica no mantiene una relación con ninguna unidad reconocible de escritura en la forma en que los términos se relacionan con las palabras, y las frases de preposición con las sentencias
            </p>
        </x-slot:content>
        <x-slot:footer>
            <x-secondary-button wire:click="closeSuggestionModal">
                Cerrar
            </x-secondary-button>
        </x-slot:footer>
    </x-dialog-modal>
</div>
