<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers as Controllers;

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users/{userId}', [Controllers\UserController::class, 'show'])->name('users');
Route::get('/users', [Controllers\UserController::class, 'index'])->name('users');

/*
Route::get('/roles/{roleId}', [App\Http\Controllers\RoleController::class, 'show']);
Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles');
Route::get('/roles/new', [App\Http\Controllers\RoleController::class, 'create']);
Route::post('/roles', [App\Http\Controllers\RoleController::class, 'store']);
Route::get('/roles/{roleId}/edit', [App\Http\Controllers\RoleController::class, 'edit']);
Route::patch('/roles/{roleId}', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/roles/{roleId}', [App\Http\Controllers\RoleController::class, 'destroy']);*/

Route::resource('roles', Controllers\RoleController::class)
    ->missing(redirect('roles.index'));


Route::get('/pages/{pageId}', [Controllers\PageController::class, 'show']);
Route::get('/pages', [Controllers\PageController::class, 'index'])->name('pages');

Auth::routes();

Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');
