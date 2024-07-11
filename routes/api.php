<?php

use App\Http\Controllers\Api\ProductController;
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


Route::get('products', [ProductController::class, 'index']);
Route::post('create-products', [ProductController::class, 'create']);
Route::post('update-products', [ProductController::class, 'update']);
Route::delete('delete-products', [ProductController::class, 'delete']);