@props(["submit", "title"])

<div class="mt-5 flex-col justify-center items-center">
    <h3 class="text-lg font-medium text-gray-900">{{ $title }}</h3>
    <form wire:submit="{{ $submit }}">
        <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
            <div class="grid grid-cols-2 gap-6">
                {{ $slot }}
            </div>
        </div>

        @if (isset($actions))
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                {{ $actions }}
            </div>
        @endif
    </form>
</div>
