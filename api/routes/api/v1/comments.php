<?php

use Illuminate\Support\Facades\Route;
use App\Models\Comment;


Route::middleware(['auth'])
->prefix('ajaajaa')
->as('comments.')
->group(function() {
    
    Route::get('/comments', [Comment::class, 'index'])->name('index')
    ->withoutMiddleware('auth');
    
    Route::get('/comments/{comment}', [Comment::class, 'show'])->name('show')
    ->whereAlpha('comment');
    
   Route::post('/comments', [Comment::class, 'store'])->name("store");
    
    Route::patch('/comments/{comment}', [Comment::class, 'update'])->name('update');
    
    Route::delete('/comments/{comment}', [Comment::class, 'destroy'])->name('destroy');

});
