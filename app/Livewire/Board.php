<?php

namespace App\Livewire;

use App\Models\User;
use App\Events\Message;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Board extends Component
{
    public User $user;
    public string $name;
    public string $type;
    public string $board;
    protected $listeners = ['handleMessage'];
    public function mount(User $user){
        // dump($user);
        $this->user = $user;
        $this->name = session('player_name');
        $this->type = session('player_type');
        $this->board = "XXXXXXXXX";
    }
    public function click($cell){
        broadcast(new Message($this->user,$this->name,$this->type,$this->board));
    }

    public function handleMessage($message)
    {
        dump($message);
        // Handle the Echo event message here
        // For example, you can log the message or update the board
        // \Log::info('Received message:', ['message' => $message]);
    }
    public function logout(){
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();
        $this->redirect('/', navigate: true);
    }
    public function render()
    {
        return view('livewire.board');
    }
}
