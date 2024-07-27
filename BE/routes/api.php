<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show')
    ->where(['id' => '[0-9]+']);
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update')
    ->where(['id' => '[0-9]+']);
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy')
    ->where(['id' => '[0-9]+']);

Route::get('/categories', [ProductController::class, 'index'])->name('category.index');
Route::get('/categories/{id}', [ProductController::class, 'show'])->name('category.show')
    ->where(['id' => '[0-9]+']);
Route::post('/categories', [ProductController::class, 'store'])->name('category.store');
Route::put('/categories/{id}', [ProductController::class, 'update'])->name('category.update')
    ->where(['id' => '[0-9]+']);
Route::delete('/categories/{id}', [ProductController::class, 'destroy'])->name('category.destroy')
    ->where(['id' => '[0-9]+']);


