<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/weakness',[TestController::class,'test']);
Route::get('/create-test-data', [TestController::class, 'createTestData']);
