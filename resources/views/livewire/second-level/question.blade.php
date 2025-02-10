<div  >
<form wire:submit='save' >
    @if($questionNumber == 1)
        <h1 class="text-center mb-2 font-semibold">¿De que trata el libro como un todo?</h1>
    @endif
    @if($questionNumber == 2)
        <h1 class="text-center mb-2 font-semibold">¿Que dice el libro en detalle y como lo dice?</h1>
    @endif
    @if($questionNumber == 3)
        <h1 class="text-center mb-2 font-semibold">¿Es el libro verdad o solo parcialmente?</h1>
    @endif
    @if($questionNumber == 4)
        <h1 class="text-center mb-2 font-semibold">¿Que importancia tiene?</h1>
    @endif

    <x-buk-easy-mde name="answer" wire:model='answer' >
        {{ $answer }}
    </x-buk-easy-mde>
    <x-input-error name="answer" />
    <x-primary-button  >
        Guardar
    </x-primary-button>
</form>
</div>
