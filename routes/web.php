<?php

use App\Http\Controllers\SystemController;
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

Route::prefix('/')->group(function () {
    Route::get('/', [SystemController::class, 'index'])->name('index');

    Route::get('/create-poll', [SystemController::class, 'create'])->name('create');
    Route::post('/create-poll', [SystemController::class, 'createAction'])->name('createAction');
    
    Route::get('/view-poll/{id}', [SystemController::class, 'view'])->name('view');
    Route::post('/view-poll', [SystemController::class, 'viewAction'])->name('viewAction');
    
    Route::get('/update-poll/{id}', [SystemController::class, 'update'])->name('update');
    Route::post('/update-poll', [SystemController::class, 'updateAction'])->name('updateAction');
    
    Route::get('/delete-poll/{id}', [SystemController::class, 'delete'])->name('delete');
});
