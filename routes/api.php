<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Dashboard\RegisterController;
use App\Http\Controllers\API\Dashboard\RoleController;
use App\Http\Controllers\API\Dashboard\UserController;
use App\Http\Controllers\API\Dashboard\PermissionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Auth
Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

// Dashboard - Users
Route::prefix('users/')->controller(UserController::class)->group(function () {
    Route::get('index', 'index');
    Route::get('show/{id}', 'show');
    Route::get('edit/{id}', 'edit');
    Route::post('update/{id}', 'update');
    Route::post('delete/{id}', 'destroy');

});

// Dashboard - Roles
Route::prefix('roles/')->controller(RoleController::class)->group(function () {
    Route::get('index', 'index');
    Route::get('show/{id}', 'show');
    Route::get('create', 'create');
    Route::get('store', 'store');
    Route::get('edit/{id}', 'edit');
    Route::get('update/{id}', 'update');
    Route::get('delete/{id}', 'destroy');

});

// Dashboard - Permissions
Route::prefix('permissions/')->controller(PermissionController::class)->group(function () {
    Route::get('index', 'index');
    Route::get('show/{id}', 'show');
    Route::get('create', 'create');
    Route::get('store', 'store');
    Route::get('edit/{id}', 'edit');
    Route::get('update/{id}', 'update');
    Route::get('delete/{id}', 'destroy');
});

