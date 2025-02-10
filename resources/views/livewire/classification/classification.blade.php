<div  class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Categoria
                </th>
                <th scope="col" class="px-6 py-3">
                    Editar
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $type  }}
                </th>
                <td class="px-6 py-4">
                    <x-primary-button wire:click='openTypeModal'>
                        Seleccionar un tipo
                    </x-primary-button>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   {{ $proposal  }}
                </th>
                <td class="px-6 py-4">
                    <x-primary-button wire:click='openProposalModal'>
                        Seleccionar categoria
                    </x-primary-button>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $myCategory  }}
                </th>
                <td class="px-6 py-4">
                    <x-primary-button wire:click='openMyCategoryModal' >
                        Seleccionar categoria
                    </x-primary-button>
                    <x-dropdown-link href="{{ route('my_categories', $book->id) }}" class="m-2"  target="_blank">
                        Administrar tus categorias
                    </x-dropdown-link >
                </td>
            </tr>
        </tbody>
    </table>

    <x-modal wire:model='typeModal' max-width="sm" >
        <div class="flex-col justify-center items-center m-4">
            <x-classification.select model="type"
                label="Selecciona el tipo de libro">
            @foreach ($types as $type )
                <option>{{ $type->value }}</option>
            @endforeach
            </x-classification.select>
            <x-primary-button class="mt-3"  wire:click='saveType'>
                Guardar
            </x-primary-button>
        </div>
    </x-modal>

    <x-modal wire:model='proposalModal' max-width="sm">
        <div class="flex-col justify-center items-center m-4">
            <x-classification.select model="proposal"
                label="Selecciona la categoria propuesta">
            @foreach ($proposals as $proposal )
                <option>{{ $proposal->value }}</option>
            @endforeach
            </x-classification.select>
            <x-primary-button class="mt-3" wire:click='saveProposal'>
                Guardar
            </x-primary-button>
        </div>
    </x-modal>

    <x-modal wire:model='myCategoryModal' max-width="sm">
        <div class="flex-col justify-center items-center m-4">
            <x-classification.select model="myCategory"
                label="Selecciona tu categoria propuesta">
            @foreach ($myCategories as $myCategory )
                <option value="{{ $myCategory->id }}" >{{ $myCategory->name }}</option>
            @endforeach
            </x-classification.select>
            <x-primary-button class="mt-3" wire:click='saveMyCategory'>
                Guardar
            </x-primary-button>
        </div>
    </x-modal>
</div>
