<div
x-data
    x-init="
    Echo.private('users.{{ $user->id }}')
            .listen('Message',(event)=>{
                console.log(event);
                $wire.handleMessage(event);
            });
    "
    >
    <div class="grid grid-cols-3">
        <button class="bg-indigo-50 p-4" wire:click="click(1)">c1</button>
        <button class="bg-indigo-50 p-4" wire:click="click(2)">c2</button>
        <button class="bg-indigo-50 p-4" wire:click="click(3)">c3</button>
    </div>
    <div class="grid grid-cols-3">
        <button class="bg-indigo-50 p-4" wire:click="click(4)">c4</button>
        <button class="bg-indigo-50 p-4" wire:click="click(5)">c5</button>
        <button class="bg-indigo-50 p-4" wire:click="click(6)">c6</button>
    </div>
    <div class="grid grid-cols-3">
        <button class="bg-indigo-50 p-4" wire:click="click(7)">c7</button>
        <button class="bg-indigo-50 p-4" wire:click="click(8)">c8</button>
        <button class="bg-indigo-50 p-4" wire:click="click(9)">c9</button>
    </div>
    <div>
        <button class="px-4 py-2 bg-red-500 text-white rounded-md " wire:click="logout">Exit</button>
    </div>

</div>
