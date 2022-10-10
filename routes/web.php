<?php

use App\Http\Controllers\AddMenusController;
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

Route::get('/', HomeController::class);
// route for control menu
Route::get('/all-menus', [AddMenusController::class, 'index']);
Route::get('/add-menus', [AddMenusController::class, 'addMenu']);
Route::post('/insert-menu', [AddMenusController::class, 'insertMenu']);
Route::get('/edit-menu/{id}', [AddMenusController::class, 'editMenu']);
Route::put('/update-menu/{id}', [AddMenusController::class, 'updateMenu']);
Route::delete('/delete-menu/{id}', [AddMenusController::class, 'destroyMenu']);
// route for userPrivileges
Route::get('/all-user-privileges', [UserPrivileges::class, 'index']);
