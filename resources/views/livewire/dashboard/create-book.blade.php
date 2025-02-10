<div class="sm:flex sm:items-center sm:ms-6" >
    <x-primary-button wire:click='open'>
        Crear
    </x-primary-button>
    <x-modal wire:model='show'>
       <livewire:dashboard.create-book-form :authoroptions="$authors" />
    </x-modal>
</div>
