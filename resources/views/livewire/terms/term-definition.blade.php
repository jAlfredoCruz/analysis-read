
<div>
    <h1 class="font-mono text-2xl font-bold text-center">Regla 5</h1>
    <p class="font-mono text-xl font-semibold">ENCONTRAR LAS PALABRAS IMPORTANTES Y, POR MEDIACION DE ELLOS LLEGAR A UN ACUEDO CON EL AUTOR, A UNO TERMINOS COMUNES CON EL ACTOR.</p>
    <div class="flex items-center justify-around mt-8">
        <x-primary-button wire:click='createTerm'>
            Crear termino
        </x-primary-button>
        <x-primary-button wire:click="openSuggestionModal">
            Sugerencias
        </x-secondary-button>
    </div>
    <div class="flex item-center justify-center m-4">
        <x-input class="block mt-1 w-full" name="search-category" placeholder="search..." wire:model.live='search' />
    </div>
    <div class="mt-2 flex item-center justify-center">
        @foreach($myTerms as $term)
            <x-card :id="$term->id"
                    :key="$term->id"
                    :title="$term->name"
                    edit-route="{{ route('term_update', ['book' => $book->id, 'term' => $term->id]) }}"
                    watch-route="{{ route('term_read', ['book' => $book->id, 'term' => $term->id ]) }}">
                <p class="text-slate-600 leading-normal font-light">
                {{ $term->definition}}
                </p>
            </x-card>
        @endforeach
        <div>
            {{ $myTerms->links() }}
        </div>
    </div>
    <x-dialog-modal id="suggestions" max-width="2xl" wire:model="showSuggestionModal">
        <x-slot:title>Sugerencias</x-slot:title>
        <x-slot:content>
            <h2 class="text-center font-bold text-xl" >Aspecto logico y gramatical</h2>
            <p class="text-lg font-mono">
                Esta abarca dos pasos un aspecto gramatical y otro lógico de sus términos. Un término puede ser vehículo de múltiples y un término puede expresarse en múltiples palabras. Solo cuando el escritor y lector piensan la misma palabra con el mismo significado hay comunicación.
            </p>
            <h2 class="text-center font-bold text-xl" >Encontrar las palabras</h2>
            <p class="text-lg font-mono">
                Por la manera en como usa las palabras, si es diferente del uso común que se le da a la palabras, o las palabras más importantes son las que crean problemas.
            </p>
            <h2 class="text-center font-bold text-xl" >Palabras tecnicas</h2>
            <p class="text-lg font-mono">
                Palabras técnicas y vocabularios especiales. Toda rama del conocimiento tiene su propio vocabulario técnico.
            </p>
            <h2 class="text-center font-bold text-xl" >Descubrir el significado</h2>
            <p class="text-lg font-mono">
                Como descubrir el significado. Hay que descubrir el significado de una palabra que no se conoce empleando el significado de todas las palabras del contexto que se comprenden. Se puede fallar en el significado y ajustar cuando sea necesario.
            </p>
        </x-slot:content>
        <x-slot:footer>
            <x-secondary-button wire:click="closeSuggestionModal">
                Cerrar
            </x-secondary-button>
        </x-slot:footer>
    </x-dialog-modal>
</div>
