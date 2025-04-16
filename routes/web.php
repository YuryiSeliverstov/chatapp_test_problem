<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/latest-chats', [\App\Http\Controllers\RestController::class, 'index']);
