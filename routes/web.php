<?php

use App\Http\Controllers\DebtorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserControler;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->prefix('dashboard')->group(function() {
    Route::get('/', [DebtorController::class, 'index'])->name('index');
    Route::get('/debtor/create', [DebtorController::class, 'create'])->name('debtor.create');
    Route::post('/debtor/store', [DebtorController::class, 'store'])->name('debtor.store');

});

Route::prefix('user')->group(function (){
    Route::get('/create', [UserControler::class, 'create'])->name('user.create');
    Route::post('/store', [UserControler::class, 'store'])->name('user.store');
});


