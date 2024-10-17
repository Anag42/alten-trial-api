<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('products')->controller(ProductController::class)->group(function () {
    Route::get('/', 'findAll');
    Route::post('/', 'create');
    Route::get('/{product}', 'findOne');
    Route::patch('/{product}', 'update');
    Route::delete('/{product}', 'delete');
});
