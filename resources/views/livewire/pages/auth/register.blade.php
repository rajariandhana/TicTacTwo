<?php

use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $userID = $this->generateUniqueUserID();
        session(['player_name'=>$this->name]);
        session(['player_type'=>'X']);
        $user = User::create([
            'id'=>$userID,
            'board'=>"EEEEEEEEE",
            'status'=>"1/2",
        ]);
        event(new Registered($user));
        Auth::login($user);
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
    private function generateUniqueuserID(): int
    {
        do {
            $userID = random_int(1000, 9999);
        } while (User::where('id', $userID)->exists());

        return $userID;
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex flex-col justify-center items-center mt-4 gap-4">
            <x-primary-button class="">
                {{ __('New Game') }}
            </x-primary-button>
            <a href="/login" class="text-red-500 text-sm">Already have a code? join instead</a>
        </div>
    </form>
</div>
