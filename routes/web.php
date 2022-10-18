<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorldController;

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
    Route::get('/game', [HomeController::class, 'index'])->name('home');
    Route::post('/worlds/item', [HomeController::class, 'item'])->name('worlds.item');
    Route::post('/worlds/save', [HomeController::class, 'save'])->name('worlds.save');
    Route::post('/worlds/store', [WorldController::class, 'store'])->name('worlds.store');
});

