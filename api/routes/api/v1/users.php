<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;


Route::middleware(['auth'])
->prefix('ajaajaa')
->as('users.')
->group(function() {
    
    Route::get('/users', [User::class, 'index'])->name('index')
    ->withoutMiddleware('auth')
    ;
    
    Route::get('/users/{user}', [User::class, 'show'])->name('show')
    ->whereAlpha('user');
    
    Route::post('/users', [User::class, 'store'])->name("store");
    
    Route::patch('/users/{user}', [User::class, 'update'])->name('update');
    
    Route::delete('/users/{user}', [User::class, 'destroy'])->name('destroy');

});
