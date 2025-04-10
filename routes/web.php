<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ChatController;

Route::get('/firebase/chats', [ChatController::class, 'index']);
Route::post('/firebase/chats/send', [ChatController::class, 'store']);
Route::get('/firebase/chats/{id}', [ChatController::class, 'show']);
Route::put('/firebase/chats/{id}', [ChatController::class, 'update']);
Route::delete('/firebase/chats/{id}', [ChatController::class, 'destroy']);
