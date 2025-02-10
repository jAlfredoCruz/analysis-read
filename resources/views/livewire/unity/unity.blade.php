<div class="mt-2">

    <h1 class="font-mono text-2xl font-bold text-center">Regla 2</h1>
    <p class="font-mono text-xl font-semibold">ESTABLECER LA UNIDAD DE TODO EL LIBRO EN UNA SOLA FRASE O UNAS CUANTAS COMO MAXIMO UN PARRAFO BREVE.</p>

    <div class="flex items-center justify-around mt-8">
        <x-primary-button wire:click='openSuggestionModal'>
            Sugerencias
        </x-primary-button>
        <x-primary-button wire:click="readSynthesis">
            Leer
        </x-secondary-button>
        <x-primary-button wire:click="editSynthesis">
            Editar
        </x-primary-button>
    </div>

    <div class="flex flex-col item-center justify-center mt-4">
        @if($read)
            <h1 class="font-mono text-xl font-bold text-center mb-4">Leer Sintesis</h1>
            <div class="flex flex-col item-center justify-center text-center">
                {!! $text !!}
            </div>
        @else
            <h1 class="font-mono text-xl font-bold text-center mb-4">Editar Sintesis</h1>
            <form wire:submit.prevent="saveSynthesis">
                <x-buk-easy-mde name="synthesis" wire:model="synthesis" ></x-buk-easy-mde>
                <x-input-error for="synthesis" />
                <div class="flex items-center justify-around mt-4">
                    <x-primary-button>
                        Guardar
                    </x-primary-button>
                </div>
            </form>
        @endif
    </div>

    <x-dialog-modal id="modal" max-width="md" wire:model="showSuggestionModaL">
        <x-slot:title>Sugerencias</x-slot:title>
        <x-slot:content>
            <h1 class="font-mono text-xl font-bold text-center">Ejemplo de la odisea</h1>
            <p class="text-lg font-mono">Un hombre está ausente de su casa durante muchos años, mientras Poseidón lo vigila celosamente. Entretanto, su hogar atraviesa una situación penosa: los pretendientes de su esposa malgastan su fortuna y se confabulan contra su hijo. Por último, vuelve al hogar empujado por una tempestad y conoce a determinadas personas; ataca a los pretendientes con sus propias manos, los destruye y queda a salvo.</p>
            <p class="text-lg font-mono font-semibold">A veces el autor expone del plan de la obra en el prólogo. Hay que señalar 2 puntos importantes:</p>
            <ul class="text-lg font-mono list-disc">
                <li>
                    <p class="text-lg font-mono">Con frecuencia puede esperar el lector que el autor, sobre todo si se trata de un buen autor, le ayude a comprender la obra.</p>
                </li>
                <li>
                    <p class="text-lg font-mono">Está destinado a prevenir al lector contra la idea de tomarse los resúmenes que hemos ofrecido como si fueran, en todos y cada uno de los casos, con una formulación absoluta y definitiva de la unidad del libro.</p>
                </li>
            </ul>
        </x-slot:content>
        <x-slot:footer>
            <x-secondary-button wire:click="closeSuggestionModal">
                Cerrar
            </x-secondary-button>
        </x-slot:footer>
    </x-dialog-modal>
</div>
