<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Home
Route::get('/', [DashboardController::class, 'index'])->middleware("auth:user");

// Login
Route::controller(LoginController::class)->group(function(){
    Route::get('/login', "index")->name('login')->middleware('guest:user');
    Route::get('/login_admin', "index_admin")->name("login_admin")->middleware("guest:user");
    Route::post('/login', "login");
    Route::post('/login_admin', "login_admin");
    Route::post('/logout', "logout");
});

// Add Guru
Route::get('/absensi', [RegisterController::class, 'index'])->middleware("auth:user");