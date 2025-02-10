<div class="">
    <h1 class="text-xl font-mono font-semibold">Escribe porque y donde esta la desinformacion</h1>
    <form wire:submit='save'>

         <x-buk-easy-mde name="text" id="desinfomation"  wire:model.blur='text' class="block mt-1 mb-4 w-full"></x-buk-easy-mde>
         <x-input-error for="text" />

         <x-primary-button class="text-left">
             Guardar
         </x-primary-button>
    </form>
 </div>
