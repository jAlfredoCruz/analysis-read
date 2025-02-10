<div class="text-center mb-5">
    <p class="m-2">{{ $question }}</p>
    <a class="m-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" href="{{ route('question', ['question' => $questionNumber, 'book' => $bookId]) }}">
        Contestar pregunta
    </a>
    <x-secondary-button class="m-2" wire:click="{{ $openModal }}">
        Leer respuesta
    </x-secondary-button>
    <x-modal wire:model="{{ $show }}">
        <div class="flex flex-col item-center justify-center text-center">
            {!! $markDownAnswer() !!}
        </div>
    </x-modal>
</div>
