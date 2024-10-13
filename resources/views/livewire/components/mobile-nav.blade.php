<x-drawer wire:model="showDrawer1" class="w-11/12 lg:w-1/3">
    <div>...</div>
    <x-button label="Close" @click="$wire.showDrawer1 = false" />
</x-drawer>
