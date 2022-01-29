<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers as Controllers;

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::resource('users', Controllers\UserController::class)
    ->missing(redirect('users.overview'));

/*
Route::get('/roles/{roleId}', [App\Http\Controllers\RoleController::class, 'show']);
Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles');
Route::get('/roles/new', [App\Http\Controllers\RoleController::class, 'create']);
Route::post('/roles', [App\Http\Controllers\RoleController::class, 'store']);
Route::get('/roles/{roleId}/edit', [App\Http\Controllers\RoleController::class, 'edit']);
Route::patch('/roles/{roleId}', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/roles/{roleId}', [App\Http\Controllers\RoleController::class, 'destroy']);*/

Route::resource('roles', Controllers\RoleController::class)
    ->missing(redirect('roles.overview'));


Route::resource('pages', Controllers\PageController::class)
    //->except('')
    ->missing(redirect('users.overview'));

Route::get('/users/{userId}/page/add', [Controllers\PageController::class, 'create_with_userid']);
Route::get('/users/{userId}/page', [Controllers\PageController::class, 'show']);
