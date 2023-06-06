<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PopularController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('login',[AuthController::class,'index'])->name('login');
    Route::get('register',[AuthController::class,'register'])->name('register');
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
  
    Route::post('proses_login',[AuthController::class,'proses_login'])->name('proses.login');
    Route::post('proses_register',[AuthController::class,'proses_register'])->name('proses.register');

    Route::post('logout',[AuthController::class,'logout'])->name('logout');

Route::group(['prefix'=>'admin','middleware' => ['auth']], function () {
 // customer
 Route::resource('customer',CustomerController::class); 
 
   // book
   Route::resource('book',BookController::class);
   
   
   // order
 Route::resource('order',OrderController::class);

 Route::resource('popular',PopularController::class);

});