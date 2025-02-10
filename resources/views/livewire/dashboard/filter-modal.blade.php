
    <div class="sm:flex sm:items-center sm:ms-6" >
        <x-primary-button wire:click='open'>
            Filtros
        </x-primary-button>
        <x-modal wire:model='show'>
            <div class="flex-col justify-center items-center m-4">
                <h3 class="text-lg font-medium text-gray-900">Filtrar</h3>

                <div class="max-w-sm mx-auto">
                    <x-label for="title" value="{{ __('Titulo') }}" />
                    <x-input id="title" wire:model='title' class="block mt-1 w-full" type="text" name="title"  required autofocus autocomplete="title" />
                </div>

                <div class="max-w-sm mx-auto">
                    <x-label for="author" value="{{ __('Autor') }}" />
                <x-input id="author" wire:model='author' class="block mt-1 w-full" type="text" name="author"  required autofocus autocomplete="author" />
            </div>
            <p>{{ $author }}</p>
                <div class="max-w-sm mx-auto">
                    <label for="types" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione un tipo</label>
                    <select id="types" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model='type'>
                        <option selected value='All' >Todos</option>
                        @foreach($types as $type)
                        <option value="{{ $type->value }}" >{{ $type->value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="max-w-sm mx-auto">
                    <label for="proposals" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione una categoria creada</label>
                    <select id="proposals" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model='proposal'>
                        <option selected value="All">Todos</option>
                        @foreach ($proposals as $proposal)
                        <option value="{{ $proposal->value }}">{{ $proposal->value }}</option>
                        @endforeach
                    </select>
                </div>

                <div wire:ignore class="max-w-sm mx-auto">
                    <label for="proposals" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione una cateoria propuesta</label>
                    <select data-pharaonic="select2" data-component-id="category" wire:model="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="All" selected>Todos</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>


                <x-primary-button class="mt-2" wire:click='filter'>
                    Filtrar
                </x-primary-button>
            </div>
        </x-modal>
    </div>

