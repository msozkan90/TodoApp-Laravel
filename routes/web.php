<?php

use Illuminate\Support\Facades\Route;
use App\Models\todo;
use Illuminate\Support\Facades\DB;
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
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete');
Route::get('/home/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update');
Route::get('/home/add/', [App\Http\Controllers\HomeController::class, 'add'])->name('add');
Route::post('/home/add/', [App\Http\Controllers\HomeController::class, 'add'])->name('add');




