<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center flex flex-col">
                    <span>Hello {{session('player_name')}}, you play as {{session('player_type')}}</span>
                </div>
                @livewire('board', ['user' => $user])

            </div>
        </div>
    </div>
</x-app-layout>
