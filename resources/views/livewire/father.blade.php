<div>
    <x-button class="mb-8" wire:click="redirigir">
        Ir a pueba
    </x-button>
    <h1 class="text-2xl font-semibold">
        Soy el componente padre
    </h1>

    <x-input  wire:model.live="name"/>

    <hr class="my-6">

    <div>
        {{-- @livewire('children', [
            'name' => $name
        ]) --}}

        <livewire:children wire:model="name"/>
    </div>
</div>
