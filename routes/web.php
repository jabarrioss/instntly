<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})
    ->middleware(['verify.shopify'])
    ->name('home');

Route::get("refund/{adapter}", [App\Http\Controllers\RefundsController::class, 'getOrderByAdapter']);

Route::resource('orders', App\Http\Controllers\OrdersController::class)->middleware(['verify.shopify']);

Route::get("register", [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get("test", [App\Http\Controllers\TestsController::class, 'test']);