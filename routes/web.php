<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
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

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::post('/admin/check', [AdminController::class, 'check'])->name('admin.check');
Auth::Routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/game', [WorldController::class, 'index'])->name('game');
    Route::post('/worlds/item', [WorldController::class, 'item'])->name('worlds.item');
    Route::post('/worlds/update', [WorldController::class, 'update'])->name('worlds.update');
    Route::post('/worlds/store', [WorldController::class, 'store'])->name('worlds.store');
    Route::delete('/worlds/delete/{world}', [WorldController::class, 'destroy'])->name('worlds.delete');
});

Route::middleware('auth:admin')->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

