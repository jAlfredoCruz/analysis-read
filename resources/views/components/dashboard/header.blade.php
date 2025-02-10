<header>
    <nav class="bg-slate-200 border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <div class="flex items-center">
                <!-- <x-application-logo class="block h-9 text-gray-800" /> -->
            </div>
            <div class="flex items-center lg:order-2">
                <x-dashboard.dropdown />
                <div class="mx-2" >
                    <livewire:dashboard.filter-modal />
                </div>
            </div>
        </div>
    </nav>
</header>
