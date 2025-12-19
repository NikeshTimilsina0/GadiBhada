<?php

use App\Http\Controllers\Admin\AdminHomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NavigationController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;



/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index']);


Auth::routes();

Route::get('/login', function () {
    if (Auth::check() && Auth::user()->hasRole('Admin')) {
        // User is logged in and is admin → redirect to admin panel
        return redirect()->route('admin.home');
    }

    // Otherwise show login view
    return view('auth.login');
})->name('login');
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Home
    Route::get('/home', [AdminHomeController::class, 'index'])->name('home');


    /*
    |--------------------------------------------------------------------------
    | Role Management
    |--------------------------------------------------------------------------
    */
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    */
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/navigations', [NavigationController::class, 'index'])->name('navigations.index');
    Route::get('/navigations/create', [NavigationController::class, 'create'])->name('navigations.create');
    Route::post('/navigations', [NavigationController::class, 'store'])->name('navigations.store');
    Route::get('/navigations/{navigation}', [NavigationController::class, 'show'])->name('navigations.show');
    Route::get('/navigations/{navigation}/edit', [NavigationController::class, 'edit'])->name('navigations.edit');
    Route::put('/navigations/{navigation}', [NavigationController::class, 'update'])->name('navigations.update');
    Route::delete('/navigations/{navigation}', [NavigationController::class, 'destroy'])->name('navigations.destroy');
});
