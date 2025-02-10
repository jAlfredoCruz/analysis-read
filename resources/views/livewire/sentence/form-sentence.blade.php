<div class="">
    <form wire:submit='save'>

         <x-label for="sentence" value="Oracion" required />
         <x-buk-textarea name="text" id="sentence"  wire:model.blur='text' class="block mt-1 mb-4 w-full"></x-buk-textarea>
        <x-input-error for="text" />

         <x-primary-button class="text-left">
             Guardar
         </x-primary-button>
    </form>
 </div>
