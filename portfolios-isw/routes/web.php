<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers as Controllers;


// admin routes
Route::prefix('admin')->group(
    function () {
        Route::get('/', [Controllers\Admin\HomeController::class, 'index'])->name('home');
        Route::get('/home', [Controllers\Admin\HomeController::class, 'index'])->name('home');

        Route::resource('users', Controllers\Admin\UserController::class)
            ->missing(redirect('admin.users.overview'));


        Route::resource('roles', Controllers\Admin\RoleController::class)
            ->missing(redirect('admin.roles.overview'));

        Route::resource('pages', Controllers\Admin\PageController::class)
            //->except('')
            ->missing(redirect('admin.users.overview'));

        Route::get('/users/{userId}/page/add', [Controllers\Admin\PageController::class, 'create_with_userid']);
        Route::post('/users/{userId}/page', [Controllers\Admin\PageController::class, 'store']);
        Route::get('/users/{userId}/page', [Controllers\Admin\PageController::class, 'show']);
        Route::post('/users/{userId}/page/change-status', [Controllers\Admin\PageController::class, 'change_status']);
    });

Auth::routes();
Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');
Route::get('/faq', function() {
    return view('faq');
});

Route::get('users', [Controllers\UserController::class, 'index']);
Route::get('/profile/{username}', [Controllers\UserController::class, 'show']);

Route::get('/account', [Controllers\AccountController::class, 'index'])->name('account');
Route::post('/account/create-page', [Controllers\AccountController::class, 'create_page']);
Route::delete('/account/delete-page/{pageId}', [Controllers\AccountController::class, 'delete_page']);
