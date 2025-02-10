<x-form-simple submit='save' title="Crear libro">
    <div>
        <x-label for="title" value="{{ __('Title') }}" />
        <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" wire:model='title' />
        <x-input-error for="name" class="mt-2" />
    </div>
    <div>
        <x-label for="isbn" value="{{ __('ISBN') }}" />
        <x-input id="isbn" class="block mt-1 w-full" type="text" name="isbn" :value="old('isbn')" required autofocus autocomplete="isbn" wire:model='isbn'/>
        <x-input-error for="isbn" class="mt-2" />
    </div>
    <div>
        <x-primary-button wire:click='addAuthor' role="button" type="button" >
            Agreagra Autor
        </x-primary-button>
    </div>
    <div></div>
    @foreach($authors as $index => $author )
        <div>
            <x-label for="authors.{{ $index }}.name" value="{{ __('Autor') }}" />
            <x-input id="authors.{{ $index }}.name" class="block mt-1 w-full" type="text" name="authors.{{ $index }}.name" :value="old('authors.{{ $index }}.name')" required autofocus autocomplete="authors.{{ $index }}.name" list="authors" wire:model="authors.{{ $index }}.name" />
            <x-input-error for="author_{{ $index }}" class="mt-2" />
        </div>
        <div>
            <x-danger-button wire:click='deleteAuthor({{ $index }})' >
                Borrar
            </x-danger-button>
        </div>
    @endforeach
    <x-slot:actions >
        <x-secondary-button class="mx-2" wire:click='modalClose' role="button" type="button" >
            Cerrar
        </x-secondary-button>
        <x-button role="submit"  type="submit" >
            {{ __('Save') }}
        </x-button>
    </x-slot:actions >
    <datalist id="authors">
    @foreach ($authorsOptions as $authorOption)
        <option value="{{ $authorOption->name }}" ></option>
    @endforeach
    </datalist>
</x-form-simple>
