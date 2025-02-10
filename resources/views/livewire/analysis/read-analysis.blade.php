<div>
   <h1 class="font-mono text-xl font-bold text-center">{{ $perfil->level }}-{{ $perfil->name}}</h1>
   <p class="font-mono text-lg text-left">
        {!! $text !!}
   </p>
   <div class="flex justify-start items-start">
        <x-primary-button wire:click='edit' class="m-3">
            Editar
        </x-primary-button>
        <x-danger-button wire:click='modal' class="m-3">
            Eliminar
        </x-danger-button>
        <x-secondary-button wire:click='back' class="m-3">
            Regresar
        </x-secondary-button>
   </div>

   <x-dialog-modal id="delete-modal" wire:model='deleteModal'>
        <x-slot:title>Eliminar</x-slot:title>
        <x-slot:content>¿Estas seguro de eliminar?</x-slot:content>
        <x-slot:footer>
            <x-danger-button class="m-3" wire:click='delete'>
                Eliminar
            </x-danger-button>
            <x-secondary-button wire:click='closeDeleteModal'>
                Cerrar
            </x-secondary-button>
        </x-slot:footer>
   </x-dialog-modal>

   <x-dialog-modal id="denegate-modal" wire:model='denegateModal'>
    <x-slot:title>Eliminar</x-slot:title>
    <x-slot:content>No se puede eliminar porque tiene sub niveles</x-slot:content>
    <x-slot:footer>
        <x-secondary-button wire:click='closeDenegateModal'>
            Cerrar
        </x-secondary-button>
    </x-slot:footer>
</x-dialog-modal>
</div>
