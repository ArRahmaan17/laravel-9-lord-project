<?php

use App\Http\Controllers\AddMenusController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserPrivileges;
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

// Login
Route::get('/', [AuthController::class, 'index']);
Route::post('/authentication', [AuthController::class, 'authentication']);
Route::get('/register', [AuthController::class, 'registration']);
Route::post('/create-user', [AuthController::class, 'createUser']);

// route for control menu
Route::resource('menus', AddMenusController::class);

// route for userPrivileges
Route::get('/all-user-privileges', [UserPrivileges::class, 'index']);
Route::put('/privilege/can-access/{id}', [UserPrivileges::class, 'setUserCanAccess']);
Route::put('/privilege/can-change/{id}', [UserPrivileges::class, 'setUserCanChange']);
Route::put('/privilege/change-status-menu/{id}', [UserPrivileges::class, 'changeStatus']);
