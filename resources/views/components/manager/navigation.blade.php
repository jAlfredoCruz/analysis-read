@props([
    'book'
])
<nav class="hidden lg:col-span-3 lg:block">
        <x-manager.nav-item name="Primer nivel"
            url="{{ route('first_level', $book->id) }}">
            <x-svgs.first />
        </x-manager.nav-item>
    <hr class="h-5 border-0" />
    <div class="space-y-1.5">
      <x-manager.nav-item name="Segundo nivel (lectura extensiva)"
            url="{{ route('extensive', $book->id) }}">
        <x-svgs.second />
      </x-manager.nav-item>
      <x-manager.nav-item name="Segundo nivel (lectura superficial)"
        url="{{ route('superficial', $book->id) }}">
        <x-svgs.second />
      </x-manager.nav-item>
      <x-manager.nav-item name="Preguntas(responder al final)"
        url="{{ route('questions', $book->id)}}">
        <x-svgs.question />
      </x-manager.nav-item>
    </div>
    <hr class="h-5 border-0" />
    <div class="space-y-1.5">
        <x-manager.nav-item name="Tercer Nivel" url="#">
            <x-svgs.third />
        </x-manager.nav-item>
        <x-manager.nav-item name="Regla 1 (Clasificacion)"
            url="{{ route('classification', $book->id) }}">
            <x-svgs.classification />
        </x-manager.nav-item>
        <x-manager.nav-item name="Regla 2 (unidad)"
            url="{{ route('unity', $book->id) }}">
            <x-svgs.unity />
        </x-manager.nav-item>
        <x-manager.nav-item name="Regla 3 (Perfilar)"
            url="{{ route('perfil', $book->id) }}">
            <x-svgs.analysis />
        </x-manager.nav-item>
        <x-manager.nav-item name="Regla 4 (Problemas)"
            url="{{ route('problem', $book->id) }}">
            <x-svgs.problem />
        </x-manager.nav-item>
        <x-manager.nav-item name="Regla 5 (Terminos)"
            url="{{ route('term', $book->id)}}">
            <x-svgs.dictionary />
        </x-manager.nav-item>
        <x-manager.nav-item name="Regla 6 (Preposiciones)"
            url="{{ route('sentence', $book->id)}}">
            <x-svgs.sentence />
        </x-manager.nav-item>
        <x-manager.nav-item name="Regla 7 (Argumentos)"
            url="{{ route('argument', $book->id) }}">
            <x-svgs.paragraph />
        </x-manager.nav-item>
        <x-manager.nav-item name="Regla 8 (Respuestas)"
            url="{{ route('answer', $book->id) }}">
            <x-svgs.answer />
        </x-manager.nav-item>
        <x-manager.nav-item name="Otras reglas (9-11)"
            url="{{ route('other_rules', $book->id) }}">
            <x-svgs.rule />s
        </x-manager.nav-item>
        <x-manager.nav-item name="Regla 12 (Desinformado)"
            url="{{ route('desinformation', $book->id) }}">
            <x-svgs.desinformation />
        </x-manager.nav-item>
        <x-manager.nav-item name="Regla 13 (Malinformado)"
            url="{{ route('misinformation', $book->id) }}">
            <x-svgs.misinformation />
        </x-manager.nav-item>
        <x-manager.nav-item name="Regla 14 (Ilogico)"
            url="{{ route('ilogic', $book->id) }}">
            <x-svgs.ilogic />
        </x-manager.nav-item>
        <x-manager.nav-item name="Regla 15 (Incompleto)"
            url="{{ route('incomplete', $book->id) }}">
            <x-svgs.incomplete />
        </x-manager.nav-item>
    </div>
    <hr class="h-5 border-0" />
    <div class="space-y-1.5">
      <a
        href="{{ route('profile.show') }}"
        class="group flex items-center justify-between gap-2 rounded-md border border-transparent px-2.5 py-2 text-sm font-semibold text-slate-900 hover:bg-indigo-100 hover:text-indigo-600 active:border-indigo-200"
      >
        <svg
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
          class="hi-solid hi-user-circle inline-block h-5 w-5 flex-none text-slate-300 group-hover:text-indigo-500"
        >
          <path
            fill-rule="evenodd"
            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
            clip-rule="evenodd"
          ></path>
        </svg>
        <span class="grow">Account</span>
      </a>
      <x-manager.nav-item name="Regresar"
            url="{{ route('dashboard') }}">
            <x-svgs.back />
        </x-manager.nav-item>
    </div>
  </nav>
