@props([
    'book'
])
<a href="javascript:void(0)" class="text-md group inline-flex items-center gap-1 font-bold tracking-wide text-slate-700 hover:text-indigo-600 active:text-slate-700 sm:text-lg" >
<svg
  class="hi-mini hi-square-3-stack-3d inline-block h-5 w-5 rotate-90 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
  fill="currentColor"
  aria-hidden="true"
>
  <path
    d="M3.196 12.87l-.825.483a.75.75 0 000 1.294l7.25 4.25a.75.75 0 00.758 0l7.25-4.25a.75.75 0 000-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 01-2.276 0L3.196 12.87z"
  />
  <path
    d="M3.196 8.87l-.825.483a.75.75 0 000 1.294l7.25 4.25a.75.75 0 00.758 0l7.25-4.25a.75.75 0 000-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 01-2.276 0L3.196 8.87z"
  />
  <path
    d="M10.38 1.103a.75.75 0 00-.76 0l-7.25 4.25a.75.75 0 000 1.294l7.25 4.25a.75.75 0 00.76 0l7.25-4.25a.75.75 0 000-1.294l-7.25-4.25z"
  />
</svg>
<span>{{ $book->title }}</span>
</a>
