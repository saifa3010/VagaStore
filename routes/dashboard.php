<?php

use App\Http\Controllers\DashBoard\CategoriesController;
use App\Http\Controllers\DashBoard\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard',[DashBoardController::class,'index']
)->middleware(['auth', 'App\Http\middleware\CheckUserType']
)->name('dashboard');



Route::get('dashboard/profile','App\Http\Controllers\Dashboard\ProfileController@edit'
)->middleware(['auth', 'App\Http\middleware\CheckUserType']
)->name('profile.edit');

Route::patch('dashboard/profile','App\Http\Controllers\Dashboard\ProfileController@update')
->middleware(['auth', 'App\Http\middleware\CheckUserType'])->name('profile.update');

Route::resource('dashboard/categories',CategoriesController::class)
->middleware(['auth','App\Http\middleware\CheckUserType']);

Route::resource('dashboard/products',ProductsController::class)
->middleware(['auth', 'App\Http\middleware\CheckUserType']);



// Route::get('pro',[ProfileController::class,'edit'])
// ->middleware(['auth', 'verified'])->name('pro.edit');

// Route::patch('pro',[ProfileController::class,'update'])
// ->middleware(['auth', 'verified'])->name('pro.update');

