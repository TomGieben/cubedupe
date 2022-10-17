<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Auth::Routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
    Route::resource('/welcome', WelcomeController::class); //beun
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
