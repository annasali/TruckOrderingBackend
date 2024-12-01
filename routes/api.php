<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/orders', [OrderController::class, 'show'])->name('orders.index');
// Route::post('/truck-requests', [OrderController::class, 'create']);
// Route::get('/orders', [OrderController::class, 'index']);
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
// Route::middleware('auth:api')->group(function () {
//     Route::post('/truck-requests', [OrderController::class, 'store']);
//     Route::get('/orders', [OrderController::class, 'index']);
// });
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
Route::middleware('auth:sanctum')->group(function () {
    // Route::post('/truck-requests', [OrderController::class, 'store']);
    Route::post('/orders', [OrderController::class, 'create']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::put('/orders/{id}', [OrderController::class, 'update']);
    // return $request->user();
});
