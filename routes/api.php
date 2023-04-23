<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\FactureController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\ProductController;


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

Route::post('login', [App\Http\Controllers\Api\LoginController::class, 'login']);

Route::apiResource('v1/factures', FactureController::class)->middleware('auth:sanctum');

Route::post('v1/register', [UserController::class, 'store'])->name('register');

Route::apiResource('v1/user', UserController::class)->only('index','update','destroy')->middleware('auth:sanctum');

Route::apiResource('v1/product',ProductController::class)->middleware('auth:sanctum');