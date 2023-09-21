<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('section/{parentId?}', [\App\Http\Controllers\SectionController::class, 'index'])->name('section.index');
Route::post('section/{parentId?}', [\App\Http\Controllers\SectionController::class, 'store'])->name('section.store');
Route::post('section-update', [\App\Http\Controllers\SectionController::class, 'edit'])->name('section.update');

Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::get('revoke-role', [\App\Http\Controllers\UserController::class, 'revokeRole'])->name('user.revoke.role');
Route::get('assign-role', [\App\Http\Controllers\UserController::class, 'assignRole'])->name('user.assign.role');

//Route::resource('section', \App\Http\Controllers\SectionController::class);

