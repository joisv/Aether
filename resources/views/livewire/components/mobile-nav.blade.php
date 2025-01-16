<div x-data @showdrawer.window="$wire.showDrawer1 = true">
    <x-drawer wire:model="showDrawer1" class="w-3/4 px-0">
       <x-menus />
    </x-drawer>
</div>
