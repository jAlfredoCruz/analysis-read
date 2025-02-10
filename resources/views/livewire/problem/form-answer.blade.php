<div>
    <h1 class="text-2xl font-bold font-mono text-center">{{ $problem->level}} {{ $problem->name}} </h1>
    <p class="font-mono text-lg text-left">
     {!! $problemText !!}
     </p>
     <div class="flex items-center justify-center">
        <form wire:submit='save'>
     
             <x-buk-easy-mde name="text" wire:model.blur='text' ></x-buk-easy-mde>
             <x-input-error for="text" />
     
             <x-primary-button class="text-left">
                 Guardar
             </x-primary-button>
        </form>
     </div>
</div>

