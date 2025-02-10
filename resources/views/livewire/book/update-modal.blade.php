<div class="sm:flex sm:items-center sm:ms-6" >
    <x-secondary-button wire:click='open'>
        Actualizar
    </x-primary-button>
    <x-modal wire:model='show'>
      <livewire:dashboard.create-book-form :book="$book" />
    </x-modal>
</div>
