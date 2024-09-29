<button {{ $attributes->merge(['class' => 'flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide dark:text-white hover:text-white transition-colors duration-200 bg-purple-500/10 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-purple-600 dark:hover:bg-purple-500/10 dark:bg-purple-600']) }}>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>

    <span>{{ $slot }}</span>
</button>