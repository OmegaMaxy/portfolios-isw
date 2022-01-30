<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers as Controllers;


// admin routes
Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('users', Controllers\UserController::class)
    ->missing(redirect('users.overview'));


Route::resource('roles', Controllers\RoleController::class)
    ->missing(redirect('roles.overview'));

Route::resource('pages', Controllers\PageController::class)
    //->except('')
    ->missing(redirect('users.overview'));

Route::get('/users/{userId}/page/add', [Controllers\PageController::class, 'create_with_userid']);
Route::get('/users/{userId}/page', [Controllers\PageController::class, 'show']);
