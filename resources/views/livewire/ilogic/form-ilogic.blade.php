<div class="">
    <h1 class="text-xl font-mono font-semibold">Escribe porque y donde hay errores logicos</h1>
    <form wire:submit='save'>

         <x-buk-easy-mde name="text" id="ilogic"  wire:model.blur='text' class="block mt-1 mb-4 w-full"></x-buk-easy-mde>
        <x-input-error for="text" />

         <x-primary-button class="text-left">
             Guardar
         </x-primary-button>
    </form>
 </div>
