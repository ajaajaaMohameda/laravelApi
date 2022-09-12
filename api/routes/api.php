<?php

use App\Helpers\Routes\RouteHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// Route::apiResource('users', User::class);


Route::prefix('v1')->group(function() {
   
    RouteHelper::loadRoutesFiles(__DIR__.'/api/v1');
   // require  __DIR__.'/api/v1/users.php';
   // require  __DIR__.'/api/v1/posts.php';
   //require  __DIR__.'/api/v1/comments.php';
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
