<?php

use App\Http\Controllers\DelayController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('orders')->name('orders.')->group(function () {
    Route::apiResource('/', OrderController::class)->only('index');
    Route::post('{order}/delay-report', [DelayController::class, 'report'])->name('delays.report');
    Route::patch('assign-to-me', [OrderController::class, 'assignToMe'])->name('assign-to-me');
});
Route::apiResource('vendors', VendorController::class)->only('index');