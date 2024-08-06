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
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="userID" :value="__('Code')" />
            <x-text-input wire:model="userID" id="userID" class="block mt-1 w-full" type="text" name="userID" required autofocus />
            <x-input-error :messages="$errors->get('userID')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="/" class="text-red-500 mb-4">back</a>
            <x-primary-button class="ms-3">
                {{ __('Join') }}
            </x-primary-button>
        </div>
    </form>
</div>
