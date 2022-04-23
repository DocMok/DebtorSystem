<?php

use App\Http\Controllers\DebtorController;
use App\Http\Controllers\FileController;
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
    Route::get('/debtor/index', [DebtorController::class, 'index'])->name('debtor.index');
    Route::get('/debtor/show/{debtor}', [DebtorController::class, 'show'])->name('debtor.show');
    Route::get('/debtor/edit/{debtor}', [DebtorController::class, 'edit'])->name('debtor.edit');
    Route::put('/debtor/update/', [DebtorController::class, 'update'])->name('debtor.update');
    Route::delete('/debtor/delete/{debtor}', [DebtorController::class, 'destroy'])->name('debtor.delete');
    Route::get('/debtor/search', [DebtorController::class, 'search'])->name('debtor.search');
    Route::get('/debtor/filter', [DebtorController::class, 'filter'])->name('debtor.filter');
    Route::get('/debtor/export-by-date', [DebtorController::class, 'exportByRange'])->name('debtor.exportByDate');
    Route::get('/debtor/export', [DebtorController::class, 'export'])->name('debtor.exportB');



    Route::get('user/create', [UserControler::class, 'create'])->name('user.create');
    Route::post('user/store', [UserControler::class, 'store'])->name('user.store');
    Route::get('user/index', [UserControler::class, 'index'])->name('user.index');
    Route::delete('user/delete/{user}', [UserControler::class, 'destroy'])->name('user.delete');
    Route::get('user/edit', [UserControler::class, 'edit'])->name('user.edit');
    Route::put('user/update', [UserControler::class, 'update'])->name('user.update');
    Route::get('user/search', [UserControler::class, 'search'])->name('user.search');


    Route::post('file/store', [FileController::class, 'store'])->name('file.store');
    Route::delete('file/delete/{}', [FileController::class, 'destroy'])->name('file.delete');

});

Route::middleware(['auth'])->get('/csrf', function(){
    return csrf_token();
})->name('csrf');


Route::prefix('user')->group(function (){

});


