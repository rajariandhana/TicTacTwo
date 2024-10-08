<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');
Route::get('/', function () {
    $user = Auth::user();
    return view('dashboard', ['user' => $user]);
})
->middleware(['auth', 'verified'])
->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/status', function () {
    return view('status',[
        'users'=>User::all()
    ]);
});
    require __DIR__.'/auth.php';
