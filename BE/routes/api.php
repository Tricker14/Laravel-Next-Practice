<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', [ProductController::class, 'getAll'])->name('product.getAll');
Route::get('/product/{id}', [ProductController::class, 'getOne'])->name('product.getOne');
Route::post('/product', [ProductController::class, 'create'])->name('product.create');
Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{id}', [ProductController::class, 'delete'])->name('product.delete');

