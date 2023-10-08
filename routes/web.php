<?php

use App\Http\Controllers\Developers\DevelopersController;
use App\Http\Controllers\Hire\HireController;
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

Route::get('/', [DevelopersController::class, 'index'])->name('developers.show');


//Route::get('/developers', function () {
//    return view('developers');
//});

Route::group(['namespace' => 'Developers'], function() {
    Route::get('/developers', [DevelopersController::class, 'index'])->name('developers.show');

    Route::get('/developers/create', [DevelopersController::class, 'create'])->name('developers.create');
    Route::post('/developers/create_dev', [DevelopersController::class, 'store'])->name('developers.store');

    Route::get('/developers/edit/{id}', [DevelopersController::class, 'edit'])->name('developers.edit');
    Route::put('/developers/update/{id}', [DevelopersController::class, 'update'])->name('developers.update');

    Route::get('/developers/delete/{id}', [DevelopersController::class, 'destroy'])->name('developers.destroy');
    Route::delete('/developers/delete/{id}', [DevelopersController::class, 'destroy'])->name('developers.destroy');

    Route::get('/developers/profile/{id}', [DevelopersController::class, 'developerProfile'])->name('hire.show');
});


Route::group(['namespace' => 'Hire'], function() {
    Route::get('/hire', [HireController::class, 'create'])->name('hire.create');
    Route::post('/hire', [HireController::class, 'store'])->name('hire.store');

    Route::get('/hire/delete/{id}', [HireController::class, 'destroy'])->name('hire.destroy');
    Route::delete('/hire/delete/{id}', [HireController::class, 'destroy'])->name('hire.destroy');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/swagger', 'swaggerdocs');
