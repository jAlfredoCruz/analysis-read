<div>
    <div class="max-w-2xl mx-auto mt-4">
            <div class="flex gap-3 bg-white border border-gray-300 rounded-xl overflow-hidden items-center justify-start flex-wrap">
                <a href="{{ route('first_level', $book->id) }}" >
                    <div class="relative w-32 h-32 flex-shrink-0">
                        <img class="absolute left-0 top-0 w-full h-full object-cover object-center transition duration-50" loading="lazy" src="https://covers.openlibrary.org/b/isbn/{{ $book->isbn }}-M.jpg" />
                    </div>

                    <div class="flex flex-col gap-2 py-2">

                        <p class="text-xl font-bold">{{ $book->title }}</p>
                        <p class="text-sm font-bold">{{ $book->isbn }}</p>

                        <p class="text-gray-500">
                            {{ $book->type ?? 'No type' }},
                           {{ $book->proposal ?? 'No Category' }},
                            {{ $book->category()->name ?? 'No Own Category' }}
                        </p>
                        <p class="text-gray-500">
                            @foreach ($authors as $author )
                                {{ $author->name }},
                            @endforeach
                        </p>
                </a>
                        <span class="flex items-center justify-start text-gray-500 flex-wrap">
                            <livewire:book.update-modal :book="$book" />
                            <x-danger-button class="mx-2 sm:max-w-sm sm:text-sm" wire:click='openDelete'>
                                Borrar
                            </x-danger-button>
                            <livewire:book.prelecture-modal />
                        </span>
                    </div>
            </div>
    </div>
    @if($deleteModal)
        <x-confirmation-modal >
            <x-slot:title>Eliminar</x-slot:title>
            <x-slot:content>¿Estás seguro de eliminar este libro?</x-slot:content>
            <x-slot:footer>
                <x-primary-button wire:click='delete'>
                    Eliminar
                </x-primary-button>
            </x-slot:footer>
        </x-confirmation-modal>
    @endif
</div>
