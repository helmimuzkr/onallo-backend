<?php

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

Route::get('register/check', [\App\Http\Controllers\Auth\RegisterController::class, 'check'])->name('api-register-check');

Route::get('provinces', [\App\Http\Controllers\API\LocationController::class, 'provinces'])
        ->name('api-provinces');
Route::get('regencies/{provinces_id}', [\App\Http\Controllers\API\LocationController::class, 'regencies'])
        ->name('api-regencies');
Route::get('districts/{regencies_id}', [\App\Http\Controllers\API\LocationController::class, 'districts'])
        ->name('api-districts');
        
Route::post('/checkout/callback', [\App\Http\Controllers\CheckoutController::class, 'callback'])
        ->name('midtrans-callback');
Route::get('/checkout/success', [\App\Http\Controllers\CheckoutController::class, 'success'])
        ->name('midtrans-success');

Route::GET('/city/{province_id}', [\App\Http\Controllers\API\LocationController::class, 'city'])
        ->name('api-city');
Route::GET('/city_id/{city_id}', [\App\Http\Controllers\API\LocationController::class, 'city_id'])
        ->name('api-city_id');
Route::POST('/rajaongkir/checkOngkir', [\App\Http\Controllers\API\LocationController::class, 'checkOngkir'])
        ->name('api-checkOngkir');