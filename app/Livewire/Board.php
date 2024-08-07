<?php

namespace App\Livewire;

use App\Events\Join;
use App\Models\User;
use App\Events\Message;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Board extends Component
{
    protected $listeners = ['handleMessage'];
    public string $status;
    public User $user;
    public string $name;
    public string $type;
    public string $opponent_name;
    public string $opponent_type;
    public string $board;
    public string $turn;
    public $buttons = [];
    public string $winner;
    public bool $finish;
    public string $finishMessage;

    public function mount(User $user){
        $this->status='waiting';
        // dump($user);
        $this->user = $user;
        $this->name = session('player_name');
        $this->type = session('player_type');
        $this->opponent_type = $this->type=='X'?'O':'X';
        if($this->type=='O'){
            broadcast(new Join($this->user, $this->name ,"O joins"));
        }
    }
    private function GameInit($enemyName){
        $this->opponent_name = $enemyName;
        $this->board = "EEEEEEEEE";
        $this->turn = "X";
        $this->buttons = [
            '', '', '',
            '', '', '',
            '', '', ''
        ];
        $this->finish = false;
        $this->status = 'playing';
    }

    public function click($cell){
        if($this->finish) return;
        if($this->type != $this->turn) return;
        if($this->board[$cell]!="E") return;
        // $this->board = "";

        broadcast(new Message($this->user, $this->name ,$this->type, $cell));
    }
    public function handleJoin($message){
        if($this->type == "X" && $message['message']=="O joins"){
            $this->GameInit($message['name']);
            sleep(1);
            broadcast(new Join($this->user, $this->name ,"X sets"));
        }
        else if($this->type == "O" && $message['message']=="X sets"){
            // dump("here");
            $this->GameInit($message['name']);
            // broadcast(new Join($this->user, $this->name ,"X sets"));
        }
        else if($message['message']== $this->opponent_type." leaves"){
            $this->status = "opponent leaves";
        }
        // else if($message['message'] == "O joins"){
        //     $this->GameInit();
        // }
        // else{
        //     broadcast(new Join($this->user, $this->name ,"O joins"));
        // }
    }

    public function handleMessage($message)
    {
        //entry point from Echo
        // dump($message);
        $this->buttons[$message['cell']] = $message['type'];
        $this->board[$message['cell']] = $message['type'];
        if($this->CheckFinish()){
            $this->winner = $message['type'];
            $this->finish = true;
            $this->status = "finish";

            $finishMessage =  ($this->winner == $this->type) ? "You win!" : "You lost :(";
        }
        if($message['type']==$this->type) $this->turn = $this->opponent_type;
        else $this->turn = $this->type;

    }
    private function CheckFinish(){
        return ($this->t(0,1,2) || $this->t(3,4,5) || $this->t(6,7,8)
            || $this->t(0,3,6) || $this->t(1,4,7) || $this->t(2,5,8)
                || $this->t(0,4,8) || $this->t(2,4,6)
        );
    }
    private function t($i,$j,$k){
        $b = $this->board;
        return ($b[$i] == $b[$j] && $b[$j] == $b[$k] && $b[$k] != 'E');
    }
    public function logout(){
        broadcast(new Join($this->user, $this->name ,$this->type . " leaves"));
        //delete User ID
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();
        $this->redirect('/register', navigate: true);
    }
    public function render()
    {
        return view('livewire.board');
    }
}
