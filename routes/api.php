<?php
use App\Http\Controllers\SportController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\FacilitieController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\subscriptionController;

use App\Http\Controllers\MediaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





Route::apiResource('sports', SportController::class);
Route::apiResource('rooms', RoomController::class);
Route::apiResource('facilitiess', FacilitieController::class);
Route::apiResource('medias', MediaController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('subscriptions', SubscriptionController::class);
Route::apiResource('offers', OfferController::class);
Route::get('payments/filter', [PaymentController::class, 'filter']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
