<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/products',[MainController::class,'mainView']);
Route::post('/products',[MainController::class,'search']);
Route::get('/products/{productId}',[MainController::class,'description']);
