
<div>
    <h1 class="font-mono text-2xl font-bold text-center">Regla 14</h1>
    <p class="font-mono text-xl font-semibold">MOSTRAR DONDE HAY UN ERROR ILOGICO DEL AUTOR.</p>
    <div class="flex items-center justify-around mt-8">
        <x-primary-button wire:click='createIlogic'>
            Señala donde hay error logico
        </x-primary-button>
        <x-primary-button wire:click="openSuggestionModal">
            Sugerencias
        </x-secondary-button>
    </div>
    <div class="flex item-center justify-center m-4">
        <x-input class="block mt-1 w-full" name="search-category" placeholder="search..." wire:model.live='search' />
    </div>
    <div class="mt-2 flex item-center justify-center">
        @foreach($myIlogics as $ilogic)
            <x-card :id="$ilogic->id"
                title=""
                :key="$ilogic->id"
                watch-route="{{ route('read_ilogic', ['book' => $book->id, 'ilogic' => $ilogic->id]) }}"
                edit-route="{{ route('update_ilogic', ['book' => $book->id, 'ilogic' => $ilogic->id]) }}" >
                {!! $ilogic->shortText() !!}
            </x-card>
        @endforeach
        <div>
            {{ $myIlogics->links() }}
        </div>
    </div>

    <x-dialog-modal id="suggestions" max-width="2xl" wire:model="showSuggestionModal">
        <x-slot:title>Sugerencias</x-slot:title>
        <x-slot:content>

        </x-slot:content>
        <x-slot:footer>
            <x-secondary-button wire:click="closeSuggestionModal">
                Cerrar
            </x-secondary-button>
        </x-slot:footer>
    </x-dialog-modal>
</div>

