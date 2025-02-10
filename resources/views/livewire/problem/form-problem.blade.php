<div class="">
    <x-primary-button wire:click="openShowLevels">
        Niveles
    </x-primary-button>
    <div class="flex items-center justify-center">
       <form wire:submit='save'>
    
            <x-label for="level" value="Nivel" />
            <x-input class="block mt-1 w-full" id="level" wire:model.blur='level' name="level" placeholder="Ejemplo: 1.1.1 o 1. o 1.1 etc..."  pattern="^\d+(\.\d+)*\.$" required />
            <x-input-error for="level" />
    
            <x-label for="name" value="Nombre" required />
            <x-input class="block mt-1 mb-4 w-full" wire:model.blur='name' id="name" name="name" required />
            <x-input-error for="name" />
    
            <x-buk-easy-mde name="text" wire:model.blur='text' ></x-buk-easy-mde>
            <x-input-error for="text" />
    
            <x-primary-button class="text-left">
                Guardar
            </x-primary-button>
       </form>
       <x-modal wire:model='showlevels'>
        <table>
            @foreach($problems as $problem)
            <tr>

                {!! $problem->points() !!}
               
                <td class="flex items-center justify-center" >
                    <p>
                    {{ $problem->level}} {{$problem->name}} 
                    </p>
                </td>
            </tr>
            @endforeach
        </table>
       </x-modal>
    </div>
</div>
