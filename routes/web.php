<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

Route::resource('products', ProductController::class);
Route::get('excel-products/export', [ProductController::class, 'Export'])->name('products.export');

Route::resource('customers', CustomerController::class);
Route::get('excel-customers/export', [CustomerController::class, 'Export'])->name('customers.export');
