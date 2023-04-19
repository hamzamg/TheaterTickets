<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="w-full overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
            @livewire('dashboard.dashboard-total-card')
        </div>
    </div>
</x-app-layout>
