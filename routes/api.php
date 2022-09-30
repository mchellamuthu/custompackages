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

Route::post('/login', \App\Http\Controllers\LoginController::class);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('categories', \App\Http\Controllers\CategoryController::class);
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('show');
    });
});
