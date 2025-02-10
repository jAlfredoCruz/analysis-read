<div class="sm:flex sm:items-center sm:ms-6">
    <x-primary-button wire:click='open'>
        Autores
    </x-primary-button>
    <x-modal wire:model='show' maxWidth="3xl" >
        <div class="flex" >
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg m-2">
                <div class="pb-4 bg-white dark:bg-gray-900">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" id="table-search" wire:model="search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Authors" />
                    </div>
                </div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre del autor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($authorsFiltered as $author)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                               {{ $author->name }}
                            </td>
                            <td class="px-6 py-4" >
                                <x-secondary-button wire:click="openIsUpdated({{ $author->id }})" >
                                    Actualizar
                                 </x-secondary-button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($isUpdated)
                <x-form-simple submit="updateAuthor" >
                    <x-slot:title>Actulizar autor</x-slot:title>
                    <x-input-error for="name" />
                    <x-input wire:model="name" name="name" label="Nombre del autor" required />
                    <div class="flex justify-end mt-4">
                        <x-secondary-button wire:click='closeIsUpdated' >
                            Cerrar
                        </x-secondary-button>
                        <x-button wire:click='updateAuthor'>
                            Actualizar
                        </x-button>
                    </div>
                </x-form-simple>
            @endif
        </div>
    </x-modal>
</div>
