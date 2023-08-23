<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckUserType;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/','App\Http\Controllers\front\HomeController@index')->name('home');
Route::get('/','App\Http\Controllers\Front\MainController@index')
->name('home');
Route::get('/products','App\Http\Controllers\Front\ProductsFrontController@index')
->name('productsF.index');
Route::get('/products/{product:slug}','App\Http\Controllers\Front\ProductsFrontController@show')
->name('productsF.show');

Route::resource('cart','App\Http\Controllers\Front\CartController');

Route::get('checkout','App\Http\Controllers\Front\CheckoutController@create')->name('checkout');
Route::post('checkout','App\Http\Controllers\Front\CheckoutController@store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';


// Route::get('/dashboard',[DashBoardController::class,'index']);






