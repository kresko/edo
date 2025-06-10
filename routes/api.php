<?php

use App\Http\Controllers\Import\CategoryImportController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Import\ProductImportController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [LoginController::class, 'login']);


Route::post('/import-categories', [CategoryImportController::class, 'importCategories'])->middleware('auth:sanctum');
Route::post('import-products', [ProductImportController::class, 'importProducts'])->middleWare('auth:sanctum');