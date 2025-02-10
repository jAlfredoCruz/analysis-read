<div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-96">
    <div class="p-4">
    @if ($title != '')
        <h5 class="mb-2 text-slate-800 text-xl font-semibold">
            {{ $title }}
        </h5>
    @endif
        {{ $slot }}
    </div>
    <div class="mx-3 border-t border-slate-200 pb-3 pt-2 flex  flex-row justify-around px-6 py-4 bg-gray-100 text-end">
      <a href="#">
        <x-svgs.eye />
      </a>
      <a href="#">
        <x-svgs.edit />
      </a>
      <livewire:delete-button :id="$id" />
    </div>
  </div>
