<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DescriptionController;

Route::get('/products',[MainController::class,'mainView']);
Route::post('/products',[MainController::class,'search']);
Route::get('/products/{productId}',[MainController::class,'description']);
Route::post('/products/{productId}/update',[DescriptionController::class,'update']);
Route::get('/products/{productId}/delete',[DescriptionController::class,'delete']);
