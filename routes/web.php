<?php

use App\Http\Controllers\GameController;
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
Route::view('/','auth.first-step-form');

/*Route::get('/',[GameController::class,'index']);*/
Route::view('/login','auth.login')->name('login');
Route::view('/register','register.create')->name('register');
Route::view('/dashboard','dahboard.index')->name('dashboard');
Route::view('/verify_password','passwords.verify')->name('verify');
Route::middleware('guest')->group(function()
{/*Route::get('/login',[GameController::class,"index"])->name('login');
  Route::get('/register',[GameController::class,"index"])->name('register');
*/
});


Route::get('/index', [GameController::class, 'index']);





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
