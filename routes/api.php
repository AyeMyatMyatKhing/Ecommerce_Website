<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::middleware(['auth:sanctum','admin'])->group(function() {
    Route::post('/logout' , [AuthController::class , 'logout']);
    Route::get('/products' , [ProductController::class , 'index']);
    Route::post('/product/store' , [ProductController::class , 'store']);
    Route::put('/product/update/{product}' , [ProductController::class , 'update']);
    Route::delete('/product/delete/{product}' , [ProductController::class , 'destory']);
});

Route::post('/login' , [AuthController::class , 'login']);
