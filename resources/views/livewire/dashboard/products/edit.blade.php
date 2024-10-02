<x-form wire:submit="submit">
    {{ $library }}
    <x-button icon="c-cog-8-tooth" class="btn-square absolute top-20 right-1 btn-warning xl:hidden flex" @click="$wire.showDrawer = true" />
    <div class="flex space-x-4" >
        <div class="w-full xl:w-[70%] space-y-1 ">
            <div class="md:flex w-full md:space-x-2" x-ref="halo">
                <div class="w-full">
                    <x-input label="Name" error-field="name" wire:model="name" x-on:blur="$dispatch('setSlug')" />
                </div>
                <div class="md:w-[40%]">
                    <x-input label="Slug" error-field="slug" wire:model="slug" />
                </div>
            </div>
            {{-- <x-editor wire:model="description" error-field="description" label="Description" --}}
            hint="The full product description" />
            <x-image-library
                wire:model="files"                 
                wire:library="library"           
                :preview="$library"               
                label="Product images"
                hint="Max 100Kb" />
            <x-slot:actions>
                <x-button label="Cancel" @click="() => {
                    Livewire.navigate('/products')
                }" />
                <x-button label="Save" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </div>
        <div class="w-[30%] hidden xl:flex">
            <div class="border-purple-200 border-2 rounded-md p-3 space-y-3 w-full">
                <h3 class="text-lg font-semibold ">Status</h3>
                <hr>
                <div>
                    <x-checkbox label="Status" wire:model="visible"
                        hint="This product will be hidden from all sales channels." />
                </div>
                <div>
                    <h3 class="text-base">Availability</h3>
                    <x-datepicker wire:model="date" icon="o-calendar" error-field="date"/>
                </div>
                <div>
                    <h3>Price</h3>
                    <x-input wire:model="price" prefix="IDR" money inline />
                </div>
                <div>
                    <h3>Stock</h3>
                    <x-input inline type="number" wire:model="stock" error-field="stock"/>
                </div>
                <div>
                    <h3>Category</h3>
                    <x-choices wire:model="category_id" :options="$categories" single
                        searchable  no-result-text="Ops! Nothing here ..." />
                </div>
            </div>
        </div>
        <x-drawer wire:model="showDrawer" class="md:w-1/2 w-9/12 lg:w-1/3" right>
            <div class="">
                <div class=" space-y-3">
                    <h3 class="text-lg font-semibold ">Status</h3>
                    <hr>
                    <div>
                        <x-checkbox label="Status" wire:model="visible"
                            hint="This product will be hidden from all sales channels." />
                    </div>
                    <div>
                        <h3 class="text-base">Availability</h3>
                        <x-datepicker wire:model="date" icon="o-calendar" error-field="date"/>
                    </div>
                    <div>
                        <h3>Price</h3>
                        <x-input wire:model="price" prefix="IDR" money inline />
                    </div>
                    <div>
                        <h3>Stock</h3>
                        <x-input inline type="number" wire:model="stock" error-field="stock"/>
                    </div>
                    <div>
                        <h3>Category</h3>
                        <x-choices wire:model="category_id" :options="$categories" single
                            searchable  no-result-text="Ops! Nothing here ..." />
                    </div>
                </div>
            </div>
        </x-drawer>
    </div>
   
</x-form>