<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers as Controllers;


// admin routes
Route::prefix('admin')->middleware(['admin'])->group(
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

        Route::resource('invites', Controllers\Admin\InviteController::class)->only(['index', 'destroy', 'store']);
    });

Auth::routes();

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');
Route::get('/faq', function () {
    return view('faq');
});
Route::get('users', [Controllers\UserController::class, 'index']);

Route::get('/invite/{hash}', function ($inviteHash) {
    return view('auth.register', compact('inviteHash'));
});

Route::middleware(['auth'])->group(function () {


    Route::get('/profile/pages', [Controllers\PageController::class, 'index']);
    Route::post('/profile/pages', [Controllers\PageController::class, 'store']);
    Route::delete('/profile/pages/{pageId}', [Controllers\PageController::class, 'destroy']);
    Route::post('/profile/pages/change-status', [Controllers\PageController::class, 'change_status']);



    Route::get('/profile/customize', [Controllers\ProfileController::class, 'index']);
    Route::patch('/profile/customize/change-background', [Controllers\ProfileController::class, 'change_background_color']);
    Route::patch('/profile/customize/change-background', [Controllers\ProfileController::class, 'change_background_image']);
    Route::post('/profile/customize/upload-image', [Controllers\ProfileController::class, 'upload_profile_picture']);
    Route::get('/profile/{username}', [Controllers\UserController::class, 'show']);

    Route::get('/account', [Controllers\AccountController::class, 'index'])->name('account');

    //Route::get('/profile', [Controllers\AccountController::class, 'index'])
});
