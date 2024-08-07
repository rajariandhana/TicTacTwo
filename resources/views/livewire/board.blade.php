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
    "
    class="bg-red-50">
    <div class="flex flex-col justify-center items-center w-full p-4">
        @if( $status == "playing")
            @if ($turn==$type)
                <span> Your turn</span>
            @else
                <span>Opponent's turn</span>
            @endif
            <div class="grid grid-cols-3 gap-1 p-4 rounded-xl bg-slate-400">
                @foreach ($buttons as $index => $text)
                    <button class="bg-indigo-50 size-16 text-4xl font-bold"
                    :class="{
                        'text-rose-500': '{{ $text }}' === 'X',
                        'text-indigo-500': '{{ $text }}' === 'O',
                    }"
                        wire:click="click({{ $index }})">
                        {{ $text }}
                    </button>
                @endforeach
            </div>
        @elseif ($status == "waiting")
            <span>Ask your friend to join with the code <span class="text-indigo-500">{{$user->id}}</span></span>
        @endif
        <div class="flex w-full justify-end">
            <button class="px-4 py-2 bg-red-500 text-white rounded-md " wire:click="logout">Quit</button>
        </div>

    </div>

    <table class="table">
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
        </tbody>
    </table>


</div>
