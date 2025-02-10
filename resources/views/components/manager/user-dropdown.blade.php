@use('Illuminate\Support\Facades\Auth')
<div class="relative inline-block">
    <!-- Dropdown Toggle Button -->
    <button
      type="button"
      class="group flex items-center justify-between rounded-md border border-transparent px-2.5 py-2 text-sm font-semibold text-slate-900 hover:bg-indigo-100 hover:text-indigo-600 active:border-indigo-200 active:bg-indigo-100 sm:gap-2"
      id="tk-dropdown-layouts-user"
      aria-haspopup="true"
      x-bind:aria-expanded="userDropdownOpen"
      x-on:click="userDropdownOpen = true"
    >
      <span class="hidden sm:inline-block">{{ Auth::user()->name }}</span>
        <svg
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
            class="hi-solid hi-chevron-down inline-block h-5 w-5 text-slate-400"
        >
            <path
            fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"
            ></path>
        </svg>
    </button>
    <!-- END Dropdown Toggle Button -->

    <!-- Dropdown -->
    <div
      x-cloak
      x-show="userDropdownOpen"
      x-transition:enter="transition ease-out duration-150"
      x-transition:enter-start="opacity-0 scale-90"
      x-transition:enter-end="opacity-100 scale-100"
      x-transition:leave="transition ease-in duration-75"
      x-transition:leave-start="opacity-100 scale-100"
      x-transition:leave-end="opacity-0 scale-90"
      x-on:click.outside="userDropdownOpen = false"
      role="menu"
      aria-labelledby="tk-dropdown-layouts-user"
      class="absolute end-0 mt-2 w-48 rounded shadow-xl shadow-slate-200 ltr:origin-top-right rtl:origin-top-left"
    >
      <div
        class="divide-y divide-slate-100 rounded bg-white ring-1 ring-slate-900/5"
      >
        <div class="space-y-1 p-2">
          <a
            role="menuitem"
            href="{{ route('profile.show') }}"
            class="group flex items-center gap-2 rounded px-3 py-2 text-sm font-medium text-slate-900 hover:bg-slate-100 hover:text-slate-700"
          >
            <svg
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
              class="hi-solid hi-user-circle inline-block h-5 w-5 text-slate-300 group-hover:text-indigo-500"
            >
              <path
                fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                clip-rule="evenodd"
              ></path>
            </svg>
            <span>Account</span>
          </a>
        </div>
        <div class="space-y-1 p-2">
          <form method="POST" action="{{ route('logout') }}">
            <button
              type="submit"
              role="menuitem"
              class="group flex w-full items-center gap-2 rounded px-3 py-2 text-sm font-medium text-slate-900 hover:bg-slate-100 hover:text-slate-700"
            >
              <svg
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
                class="hi-solid hi-lock-closed inline-block h-5 w-5 text-slate-300 group-hover:text-indigo-500"
              >
                <path
                  fill-rule="evenodd"
                  d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                  clip-rule="evenodd"
                ></path>
              </svg>
              <span>Logout</span>
            </button>
          </form>
        </div>
      </div>
    </div>
    <!-- END Dropdown -->
  </div>
