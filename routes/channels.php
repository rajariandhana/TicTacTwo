<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;


Broadcast::channel("users.{id}",function($user, $id){
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat',function(){

});

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });
// Broadcast::channel('users.7711',function(){
//     return true;
// });
