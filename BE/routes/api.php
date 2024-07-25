<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show')
    ->where(['id' => '[0-9]+']);
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update')
    ->where(['id' => '[0-9]+']);
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy')
    ->where(['id' => '[0-9]+']);

