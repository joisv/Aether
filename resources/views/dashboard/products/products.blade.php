<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="lg:py-12">
        <div class="max-w-7xl mx-auto lg:px-6 xl:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   <livewire:dashboard.products.products />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>