<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\IncomingController;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\ShippingItemController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::middleware('guest')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    // Route::post('register', [RegisteredSanctumController::class, 'store']);
});

Route::prefix('items')->controller(ItemController::class)->name('item.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::put('/{idItem}/update', 'update')->name('update');
    Route::delete('/{idItem}', 'destroy')->name('delete');
});

Route::prefix('incomings')->controller(IncomingController::class)->name('incoming.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    // Route::put('/{idItem}/update', 'update')->name('update');
    // Route::delete('/{idItem}', 'destroy')->name('delete');
});

Route::prefix('shippings')->controller(ShippingItemController::class)->name('shipping.')->group(function () {
    // Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    // Route::put('/{idItem}/update', 'update')->name('update');
    // Route::delete('/{idItem}', 'destroy')->name('delete');
});
