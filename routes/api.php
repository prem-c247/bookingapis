<?php

use App\Http\Controllers\BookingController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-booking', [BookingController::class, 'index']);
Route::get('/busy-days', [BookingController::class, 'bookingDays']);

Route::get('/free-days', [BookingController::class, 'freeDays']);

Route::post('/booking-save', [BookingController::class, 'store']);
