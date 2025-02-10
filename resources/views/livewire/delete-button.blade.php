<div>
   <x-svgs.trash />

   <x-dialog-modal id="delete" max-width="2xl" wire:model='showDialog'>
        <x-slot:title>Eliminar</x-slot:title>
        <x-slot:content>¿Esta seguro de eliminar?</x-slot:content>
        <x-slot:footer>
            <x-secondary-button class="m-3" wire:click='closeShowModal'>
                Cerrar
            </x-secondary-button>
            <x-primary-button class="m-3" wire:click='delete'>
                Eliminar
            </x-primary-button>
        </x-slot:footer>
   </x-dialog-modal>
</div>
