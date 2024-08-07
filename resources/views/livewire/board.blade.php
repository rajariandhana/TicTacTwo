<div x-data
    x-init="
    {{-- Echo.join('users.{{$user->id}}')
        .here((event)=>{
            console.log("here");
    }); --}}
    Echo.private('users.{{ $user->id }}')
        .listen('Message', (event) => {
            console.log(event);
            $wire.handleMessage(event);
    });
    Echo.private('users.{{ $user->id }}')
        .listen('Join', (event) => {
            console.log(event);
            $wire.handleJoin(event);
    });
    "
    class="">

    <div class="flex flex-col justify-center items-center w-full p-4 gap-4">
        {{-- @if ($status == "finish")
            <div>
                {{$finishMessage}}
            </div>
        @endif --}}
        @if ($status == "finish")
            <div class="fixed top-0 right-0 left-0 z-10 flex justify-center items-center w-full h-full">
                <div class="fixed top-0 right-0 left-0 z-10 flex justify-center items-center w-full h-full bg-black opacity-60">
                </div>
                <div class="fixed bottom-20 right-50 bg-gray-100 rounded-xl z-20 opacity-100 flex flex-col justify-center items-center w-96 h-36">
                    <span class="flex w-full justify-center text-center mb-4 text-2xl text-black">
                        {{$finishMessage}}xxx
                    </span>
                    <div class="flex w-full justify-center px-24">
                        {{-- <button class="px-4 py-2 bg-indigo-500 text-white rounded-md " wire:click="play">Play again</button> --}}
                        <button class="px-4 py-2 bg-red-500 text-white rounded-md " wire:click="logout">Quit</button>
                    </div>
                </div>
            </div>
        @endif

        @if ($status == "waiting")
            <span>Ask your friend to join with the code <span class="text-indigo-500">{{$user->id}}</span></span>
        @else
            @if ($turn==$type)
                <span>
                    <span class="text-lg" :class="{
                        'text-rose-500': '{{ $type }}' === 'X',
                        'text-indigo-500': '{{ $type }}' === 'O',
                    }"> Your</span> turn
                </span>
            @else
                <span>
                    <span class="text-lg" :class="{
                        'text-indigo-500': '{{ $type }}' === 'X',
                        'text-rose-500': '{{ $type }}' === 'O',
                    }">{{$opponent_name}}</span>'s turn
                </span>
            @endif
            <div class="grid grid-cols-3 gap-4 p-4 rounded-xl bg-slate-900">
                @foreach ($buttons as $index => $text)
                    <button class="bg-slate-800 size-28 text-8xl font-bold"
                    :class="{
                        'text-rose-500': '{{ $text }}' === 'X',
                        'text-indigo-500': '{{ $text }}' === 'O',
                    }"
                        wire:click="click({{ $index }})">
                        {{ $text }}
                    </button>
                @endforeach
            </div>
        @endif


    </div>

    {{-- <table class="table">
        <tbody>
            <tr>
                <td>name</td>
                <td>{{$name}}</td>
            </tr>
            <tr>
                <td>type</td>
                <td>{{$type}}</td>
            </tr>
            <tr>
                <td>opponent_name</td>
                <td>{{$opponent_name}}</td>
            </tr>
            <tr>
                <td>opponent_type</td>
                <td>{{$opponent_type}}</td>
            </tr>
            <tr>
                <td>board</td>
                <td>{{$board}}</td>
            </tr>
            <tr>
                <td>turn</td>
                <td>{{$turn}}</td>
            </tr>
            <tr>
                <td>status</td>
                <td>{{$status}}</td>
            </tr>
            <tr>
                <td>finishMessage</td>
                <td>{{$finishMessage}}</td>
            </tr>
        </tbody>
    </table> --}}


</div>
