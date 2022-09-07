<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\bookController::class, 'index'])->name('home');
Route::delete('/delete/{id}', [App\Http\Controllers\bookController::class, 'destroy'])->name('delete');
Route::get('/list', [App\Http\Controllers\bookController::class, 'books'])->name('books');
Route::get('/filter/{id}', [App\Http\Controllers\bookController::class, 'filter'])->name('filter');
Route::get('/show/{id}', [App\Http\Controllers\bookController::class, 'show'])->name('show');
Route::post('/reserve', [App\Http\Controllers\bookController::class, 'store'])->name('reserve');
Route::post('/register', [App\Http\Controllers\bookController::class, 'register'])->name('register');




