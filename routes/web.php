<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/weakness123',[TestController::class,'test'])->name('weakness');
Route::get('/create-test-data', [TestController::class, 'createTestData']);
Route::get('/product/list', [ProductController::class,'index'])->name('product_list');
Route::get('/product/create', [ProductController::class,'create'])->name('product_create');
Route::post('/product/store', [ProductController::class,'store'])->name('product_store');
