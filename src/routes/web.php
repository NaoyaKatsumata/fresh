<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DescriptionController;
use App\Http\Controllers\RegisterController;

Route::get('/products',[MainController::class,'mainView']);
Route::post('/products',[MainController::class,'search']);
Route::get('/products/register',[MainController::class,'addProductsView']);
Route::post('/products/register',[RegisterController::class,'register']);
Route::get('/products/{productId}',[MainController::class,'description']);
Route::post('/products/{productId}/update',[DescriptionController::class,'update']);
Route::get('/products/{productId}/delete',[DescriptionController::class,'delete']);
