<div>
    {{-- <h1>{{$title}}</h1>
    <p>{{$name}}</p>
    <p>{{$email}}</p> --}}
    <div>
        <x-input type="text" wire:model.live="name"/>
        <x-button wire:click="save">
            Save
        </x-button>
    </div>
    {{$name}}
</div>
