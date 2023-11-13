<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RegisterController;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\ItemController;
use \App\Http\Controllers\LogoutController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[RegisterController::class, 'store']);
Route::post('/login',[LoginController::class, 'check']);
Route::post('/logout', [LogoutController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/items', [ItemController::class, 'index']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/item/store', [ItemController::class, 'store']);
});
Route::put('item/{id}',[ItemController::class,'update']);
Route::delete('item/{id}',[ItemController::class,'destroy']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/item/{id}', [ItemController::class, 'edit']);
});
