<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// Auth::routes();
Route::get('/', function (Request $request) {
    return view('welcome');
})
->middleware(['verify.shopify'])
->name('home');

Route::get("orders/{adapter}/show", [App\Http\Controllers\OrdersController::class, 'getOrderByAdapter']);
Route::get('orders/{adapter}/index', [App\Http\Controllers\OrdersController::class, 'index']);

Route::get("test", [App\Http\Controllers\TestsController::class, 'test']);
