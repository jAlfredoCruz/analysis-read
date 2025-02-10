<x-dashboard-layout>
    <x-dashboard.header />
    <main class="mt-6 mx-4">
        <div class="flex" >
            <livewire:dashboard.create-book />
            <livewire:dashboard.manager-author />
        </div>
        <div class="items-center justify-center mt-4">
            <livewire:book.book-list />
        </div>
    </main>
</x-dashboard-layout>
