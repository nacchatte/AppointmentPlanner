<?php

use App\Http\Controllers\Backend\AdminController;
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

Route::get('register', function () {
    return view('register');
})->name('register');

Route::prefix('backend')->group(function () {
    Route::get('dashboard', [AdminController::class,'dashboard'])->name('dashboard');
    Route::get('appview', [AdminController::class,'appview'])->name('appview');
    Route::get('appadd', [AdminController::class,'appadd'])->name('appadd');
    Route::get('custview', [AdminController::class,'custview'])->name('custview');
    Route::get('custadd', [AdminController::class,'custadd'])->name('custadd');
    Route::get('staffview', [AdminController::class,'staffview'])->name('staffview');
    Route::get('staffadd', [AdminController::class,'staffadd'])->name('staffadd');
});
