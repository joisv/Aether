<div class="w-full">
    <x-menu active-bg-color="bg-purple-500/10 " >
        <!-- Logo -->
        <div class="shrink-0 lg:flex items-center lg:mb-8 mb-0 hidden">
            <a href="{{ route('dashboard') }}" wire:navigate>
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
        </div>

        <!-- Navigation Links -->
        <x-menu-sub title="Dashboard" icon="m-cursor-arrow-ripple">
            <x-menu-item title="main" :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate />
            <x-menu-item title="analitycs" wire:navigate />
        </x-menu-sub>
        <x-menu-sub title="Shops" icon="o-rectangle-group">
            <x-menu-item title="products"  wire:navigate :href="route('products')" :active="request()->routeIs('products') || request()->routeIs('product.create') || request()->routeIs('product.edit')"/>
            <x-menu-item title="categories"  wire:navigate :href="route('categories')" :active="request()->routeIs('categories')"/>
            <x-menu-item title="orders"  wire:navigate />
        </x-menu-sub>
        <x-menu-item title="Customers" icon="s-user-group" wire:navigate :href="route('customers')" :active="request()->routeIs('customers')"/>
        <x-menu-sub title="Blog" icon="o-document">
            <x-menu-item title="posts" wire:navigate/>
        </x-menu-sub>
        <x-menu-sub title="Settings" icon="c-cog-8-tooth">
            <x-menu-item title="basic" wire:navigate :href="route('basics')" :active="request()->routeIs('basics')"/>
            <x-menu-item title="my account" wire:navigate :href="route('profile')" :active="request()->routeIs('profile')"/>
            <x-menu-item title="feedback" wire:navigate />
        </x-menu-sub>
        {{-- <x-theme-toggle /> --}}
    </x-menu>
</div>