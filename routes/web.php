<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/app/{slug?}/{app?}', [AppController::class, 'appDetails'])->name('app.details');
Route::get('/game/{slug?}/{game?}', [AppController::class, 'gameDetails'])->name('game.details');
Route::get('/category/{slug?}/{category?}', [CategoryController::class, 'index'])->name('category.index');
Route::get('/apps/all', [AppController::class, 'allApps'])->name('app.all');
Route::get('/games/all', [AppController::class, 'allGames'])->name('game.all');

