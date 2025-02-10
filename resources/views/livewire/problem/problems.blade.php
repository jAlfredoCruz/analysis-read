
<div>
    @if(!$answer)
        <h1 class="font-mono text-2xl font-bold text-center">Regla 4</h1>
        <p class="font-mono text-xl font-semibold">AVERIGUAR EN QUE CONSISTEN LOS PROBLEMAS QUE SE PLANTEA EL AUTOR.</p>
    @endif
    @if($answer)
        <h1 class="font-mono text-2xl font-bold text-center">Regla 8</h1>
        <p class="font-mono text-xl font-semibold">RESOLVER EN CONSISTEN LAS SOLUCIONES DEL AUTOR</p>
    @endif
    <div class="flex items-center justify-around mt-8">
    @if(!$answer)
        <x-primary-button wire:click='createProblem'>
            Crear Problema
        </x-primary-button>
    @endif
        <x-primary-button wire:click="openSuggestionModal">
            Sugerencias
        </x-secondary-button>
    </div>
    <div class="flex item-center justify-center m-4">
        <x-input class="block mt-1 w-full" name="search-category" placeholder="search..." wire:model.live='search' />
    </div>
    <div class="mt-2">
        <table>
            @foreach($myProblems as $problem)
            <tr>

                {!! $problem->points() !!}
               
                <td class="flex items-center justify-center" >
                    <a class="text-sky-700 text-lg  hover:cursor-pointer hover:text-sky-900 font-mono"
                    href="{{ route($route, ['book' => $book->id, 'problem' => $problem->id])}}">
                    {{ $problem->level}} {{$problem->name}} </a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <x-dialog-modal id="suggestions" max-width="2xl" wire:model="showSuggestionModal">
        <x-slot:title>Sugerencias</x-slot:title>
        <x-slot:content>
            @if(!$answer)
                <p class="text-lg font-mono">No solo haber comprendido todos los interrogantes si no situarlos en un orden inteligible. ¿Cuales son los primario y cuales los secundarios? , ¿Cuáles deben contestarse en primer lugar y cuales en segundo?</p>
                <p class="text-lg font-mono">Problemas teoricos.</p>
                <ol class="font-mono text-xl list-decimal list-inside">
                    <li>¿Existe algo?</li>
                    <li>¿Qué clase de problemas es?</li>
                    <li>Qué lo ha producido o bajo qué circunstancias puede existir, o porque exististe?</li>
                    <li>¿Qué objetivo persigue?</li>
                    <li>¿Cuáles son las consecuencias de su existencia?</li>
                    <li>¿En qué consisten sus características?</li>
                    <li>¿Cuáles son sus relaciones con puntos similares o diferentes?</li>
                </ol>
                <p class="text-lg font-mono">Problemas practicos.</p>
                <ol class="font-mono text-xl list-decimal list-inside">
                    <li>¿Qué medios habría que elegir para alcanzar un fin concreto?</li>
                    <li>¿Qué hay que hacer para obtener un objetivo dado y que orden hay que seguir?</li>
                    <li>¿Bajo qué circunstancias que se debe hacer?</li>
                </ol>
            @endif
            @if($answer)
                <ol class="font-mono text-xl list-decimal list-inside">
                    <li>¿Cuáles problemas intentaba resolver el autor resolvió?</li>
                    <li>¿Ha planteado otros?</li>
                    <li>¿Cuáles es consiente que no ha logrado resolver los problemas?</li>
                </ol>
            @endif
        </x-slot:content>
        <x-slot:footer>
            <x-secondary-button wire:click="closeSuggestionModal">
                Cerrar
            </x-secondary-button>
        </x-slot:footer>
    </x-dialog-modal>
    <x-dialog-modal id="answerSuggestion" max-width="2xl" wire:model='showAnswerSuggestionModal'>
        <x-slot:title>Sugerencias</x-slot:title>
        <x-slot:content></x-slot:content>
        <x-slot:footer>
            <x-secondary-button wire:click="closeAnswerSuggestionModal">
                Cerrar
            </x-secondary-button>
        </x-slot:footer>
    </x-dialog-modal>
</div>
