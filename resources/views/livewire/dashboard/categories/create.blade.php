<div >
    <x-form wire:submit="save" >
        {{-- Full error bag --}}
        {{-- All attributes are optional, remove it and give a try --}}
        <x-errors title="Oops!" description="Please, fix them." icon="o-face-frown" />

        <x-input label="Name" wire:model="name" x-on:blur="$dispatch('setSlug')"/>
        <x-input label="Slug" wire:model="slug" />

        <x-slot:actions>
            {{-- No target spinner --}}
            <x-button label="Cancel" wire:click="$parent.modal_create = false"/>

            {{-- Target is `save2` --}}
            <x-button label="Save" type="submit" class="btn-primary" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>
