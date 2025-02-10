<div  class="relative overflow-x-auto">
    <x-primary-button  class="m-2" wire:click='openCreateModal'>
        Agregar categoria
    </x-primary-button>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Categoria
                    <x-input class="block mt-1 w-full" name="search-category" placeholder="search.." wire:model='search' />
                </th>
                <th scope="col" class="px-6 py-3">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ( $myCategories as $myCategory)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   {{ $myCategory->name }}
                </th>
                <td class="px-6 py-4">
                    <x-primary-button class="m-2" wire:click='editCategory({{ $myCategory->id }}, {{ $myCategory->name }})'>
                        Editar
                    </x-primary-button>
                   <x-danger-button  onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                            wire:click="deleteCategory({{ $myCategory->id }})" >
                        Eliminar
                   </x-danger-button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <x-modal wire:model='showCreateModal'>
        <div class="flex-col justify-center items-center m-4">
            <x-input class="block mt-1 w-full" name="add-category" wire:model='newCategory' />
            <x-primary-button class="mt-3" wire:click='createCategory'>
                Guardar
            </x-primary-button>
        </div>
    </x-modal>
    <x-modal wire:model='showUpdateModal'>
        <div class="flex-col justify-center items-center m-4">
            <x-input class="block mt-1 w-full" name="add-category" wire:model='categoryName' />
            <x-primary-button class="mt-3" wire:click='update   Category'>
                Guardar
            </x-primary-button>
        </div>
    </x-modal>
</div>
