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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users/{userId}', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');

Route::get('/roles/{roleId}', [App\Http\Controllers\RoleController::class, 'index']);
Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles');

Route::get('/pages/{pageId}', [App\Http\Controllers\PageController::class, 'index']);
Route::get('/pages', [App\Http\Controllers\PageController::class, 'index'])->name('pages');
