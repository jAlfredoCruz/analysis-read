<div class="">
   <form wire:submit='save'>

        <x-label for="name" value="Nombre" required />
        <x-input class="block mt-1 mb-4 w-full" wire:model.blur='term' id="name" name="name" required />
        <x-input-error  for="name" />

        <x-label for="definition" value="Definicion" required />
        <x-buk-textarea name="definition" id="definition"  wire:model.blur='definition' class="block mt-1 mb-4 w-full"></x-buk-textarea>
        <x-input-error for="definition" />

      <x-primary-button class="text-left">
            Guardar
        </x-primary-button>
   </form>
</div>
