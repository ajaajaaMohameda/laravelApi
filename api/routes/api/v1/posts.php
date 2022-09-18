<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;


// Route::middleware(['auth'])
Route::as('posts.')
//->prefix('ajaajaa')
// ->as('posts.')
->group(function() {
    
    Route::get('/posts', [PostController::class, 'index'])->name('index')
    ;
    
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('show')
    ->whereAlpha('post');
    
    Route::post('/posts', [PostController::class, 'store'])->name("store");
    
    Route::patch('/posts/{post}', [PostController::class, 'update'])->name('update');
    
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('destroy');

});
