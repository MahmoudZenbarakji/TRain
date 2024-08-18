<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\ClubController;

Route::get('/club', [ClubController::class, 'index']);
Route::post('/subscribe', [ClubController::class, 'applySubscription'])->name('club.subscribe');
Route::get('/', [ClubController::class, 'index'])->name('welcome');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
