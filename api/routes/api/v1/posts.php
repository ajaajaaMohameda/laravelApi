<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;


Route::middleware(['auth'])
->prefix('ajaajaa')
->as('posts.')
->group(function() {
    
    Route::get('/posts', [Post::class, 'index'])->name('index')
    ->withoutMiddleware('auth')
    ;
    
    Route::get('/posts/{post}', [Post::class, 'show'])->name('show')
    ->whereAlpha('post');
    
    Route::post('/posts', [Post::class, 'store'])->name("store");
    
    Route::patch('/posts/{post}', [Post::class, 'update'])->name('update');
    
    Route::delete('/posts/{post}', [Post::class, 'destroy'])->name('destroy');

});
