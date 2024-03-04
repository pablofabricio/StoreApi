<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->withoutMiddleware('auth-jwt')->name('auth.jwt');
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::get('products', [ProductController::class, 'all']);

Route::post('sales', [SaleController::class, 'create']);
Route::get('sales', [SaleController::class, 'all']);
Route::get('sales/{id}', [SaleController::class, 'find']);
Route::delete('sales/{id}', [SaleController::class, 'destroy']);
Route::post('sales/products', [SaleController::class, 'addProductsToSale']);
