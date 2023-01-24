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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('sales/view/{userId}', [App\Http\Controllers\SalesController::class, 'view'])->name('view');
Route::post('sales/create', [App\Http\Controllers\SalesController::class, 'create'])->name('create');
Route::get('sales/{sale}', [App\Http\Controllers\SalesController::class, 'getSales'])->name('getSales');
Route::put('sales/{id}', [App\Http\Controllers\SalesController::class, 'update'])->name('update');
