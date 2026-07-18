
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/posts',[PostController::class,'index']);

Route::get('/my-posts', [PostController::class, 'myPosts']);

Route::get('/categories', [PostController::class, 'myPosts']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/posts', [PostController::class, 'create']);
});