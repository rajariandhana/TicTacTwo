<nav class="-mx-3 h-full flex flex-col justify-center items-center gap-y-4">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70"
        >
            Dashboard
        </a>
    @else
        <a
            href="{{ route('login') }}"
            class="rounded-xl w-64 p-3 text-center bg-indigo-500 text-white font-semibold  ring-1 ring-transparent transition "
        >
            Join game
        </a>

        @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="rounded-xl w-64 p-3 text-center bg-indigo-500 text-white font-semibold  ring-1 ring-transparent transition "
            >
                New game
            </a>
        @endif
    @endauth
</nav>
