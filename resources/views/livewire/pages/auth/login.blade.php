<?php

use App\Models\User;
use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\Form;
use Illuminate\Support\Facades\Auth;

new #[Layout('layouts.guest')] class extends Component
{
    public $name;
    public $userID;

    public function mount()
    {
        $this->name = '';
        $this->userID = '';
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'userID' => ['required', 'integer'],
        ]);
        // dump("h");

        $user = User::find($this->userID);

        if (!$user) {
            $this->addError('userID', 'The provided user ID does not exist.');
            return;
        }

        Session::regenerate();

        session(['player_name' => $this->name]);
        session(['player_type' => 'O']);

        Auth::login($user);

        $this->redirect(route('dashboard'));
    }

};
?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="" type="text" name="name" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="mb-4">
            <x-input-label for="userID" :value="__('Code')" />
            <x-text-input wire:model="userID" id="userID" class="" type="text" name="userID" required autofocus />
            <x-input-error :messages="$errors->get('userID')" class="mt-2" />
        </div>

        <div class="flex flex-col justify-center items-center mt-4 gap-4">
            <x-primary-button class="">
                {{ __('Join Game') }}
            </x-primary-button>
            <a href="/newgame" class="text-indigo-500 text-sm">create new game instead</a>
        </div>
    </form>
</div>
