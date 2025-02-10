
<div>
    <h1 class="font-mono text-2xl font-bold text-center">Regla 6</h1>
    <p class="font-mono text-xl font-semibold">SEÑALAR LAS ORACIONES MAS IMPORTANTES DE UN LIBRO Y DESCUBRIR LAS PROPOCISIONES QUE CONTIENEN</p>
    <div class="flex items-center justify-around mt-8">
        <x-primary-button wire:click='createSentence'>
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
        @foreach($mySentences as $sentence)
            <x-card :id="$sentence->id"
                title=""
                :key="$sentence->id"
                watch-route="{{ route('read_sentence', ['book' => $book->id, 'sentence' => $sentence->id]) }}"
                edit-route="{{ route('update_sentence', ['book' => $book->id, 'sentence' => $sentence->id]) }}">
                <p class="text-slate-600 leading-normal font-light">
                {{ $sentence->text }}
                </p>
            </x-card>
        @endforeach
        <div>
            {{ $mySentences->links() }}
        </div>
    </div>
    <x-dialog-modal id="suggestions" max-width="2xl" wire:model="showSuggestionModal">
        <x-slot:title>Sugerencias</x-slot:title>
        <x-slot:content>
            <ul class="font-mono text-xl list-disc">
                <li>Donde se lee con mucha más lentitud</li>
                <li>Expresa juicios que apoya su argumentación.</li>
                <li>Las oraciones que subraye el autor</li>
                <li>Los párrafos que no se entienden.</li>
                <li>Donde están las palabras importantes</li>
                <li>Oraciones con secuencia de principio al final</li>
                <li>Cuando nos topemos con un argumento</li>
                <li>Se descubren las preposiciones interpretando todas las palabras que integran la oración y, sobre todo, las palabras principales.</li>
                <li>Si ere capaz de traducir la oración a otra lengua significa que ha comprendido la preposición.</li>
                <li>Hacer las siguientes preguntas: ¿Puede señalar una experiencia que haya tenido que describa la preposición o guarde algún tipo de relación con ella? ¿Puede poner un ejemplo de la verdad general que ha sido enunciado a un caso contrato?</li>
                <li>Quien no tiene conocimiento de gramática y lógica termina siendo esclavo de las palabras.</li>
            </ul>
        </x-slot:content>
        <x-slot:footer>
            <x-secondary-button wire:click="closeSuggestionModal">
                Cerrar
            </x-secondary-button>
        </x-slot:footer>
    </x-dialog-modal>
</div>
