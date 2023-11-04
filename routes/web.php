<?php

use App\Http\Controllers\Developer\DeveloperController;
use App\Http\Controllers\Hire\HireController;
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

Route::get('/', [DeveloperController::class, 'index'])->name('developers.show');


//Route::get('/developers', function () {
//    return view('developers');
//});

Route::group(['namespace' => 'Developers'], function() {
    Route::get('/developers', [DeveloperController::class, 'index'])->name('developers.show');

    Route::get('/developers/create', [DeveloperController::class, 'create'])->name('developers.create');
    Route::post('/developers/create_dev', [DeveloperController::class, 'store'])->name('developers.store');

    Route::get('/developers/edit/{id}', [DeveloperController::class, 'edit'])->name('developers.edit');
    Route::put('/developers/update/{id}', [DeveloperController::class, 'update'])->name('developers.update');

    Route::get('/developers/delete/{id}', [DeveloperController::class, 'destroy'])->name('developers.destroy');
    Route::delete('/developers/delete/{id}', [DeveloperController::class, 'destroy'])->name('developers.destroy');

    Route::get('/developers/profile/{id}', [DeveloperController::class, 'developerProfile'])->name('hire.show');
});


Route::group(['namespace' => 'Hire'], function() {
    Route::get('/hire', [HireController::class, 'create'])->name('hire.create');
    Route::post('/hire', [HireController::class, 'store'])->name('hire.store');

    Route::get('/hire/delete/{id}', [HireController::class, 'destroy'])->name('hire.destroy');
    Route::delete('/hire/delete/{id}', [HireController::class, 'destroy'])->name('hire.destroy');
});
