<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers as Controllers;


// admin routes
Route::prefix('admin')->group(
    function () {
        Route::get('/', [Controllers\Admin\HomeController::class, 'index'])->name('home');
        Route::get('/home', [Controllers\Admin\HomeController::class, 'index'])->name('home');

        Route::resource('users', Controllers\Admin\UserController::class)
            ->missing(redirect('users.overview'));


        Route::resource('roles', Controllers\Admin\RoleController::class)
            ->missing(redirect('roles.overview'));

        Route::resource('pages', Controllers\Admin\PageController::class)
            //->except('')
            ->missing(redirect('users.overview'));

        Route::get('/users/{userId}/page/add', [Controllers\Admin\PageController::class, 'create_with_userid']);
        Route::get('/users/{userId}/page', [Controllers\Admin\PageController::class, 'show']);
    });

Auth::routes();
Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', Controllers\UserController::class)->only(['index', 'show']);
