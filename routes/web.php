<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SimplePresentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login-proses', [LoginController::class,'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class,'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/simple-present', [SimplePresentController::class,'index'])->name('simple-present');
Route::get('/simple-present-quest1', [SimplePresentController::class,'quest1'])->name('simple-present-quest1');
Route::get('/simple-present-quest2', [SimplePresentController::class,'quest2'])->name('simple-present-quest2');
Route::get('/simple-present-quest3', [SimplePresentController::class,'quest3'])->name('simple-present-quest3');

Route::post('/add-exp', [ExpController::class, 'addExp'])->name('addexp');
Route::post('/updateprogress1Q2', [ExpController::class, 'updateProgress1Q2'])->name('updateprogress1Q2');
Route::post('/updateprogress1Q3', [ExpController::class, 'updateProgress1Q3'])->name('updateprogress1Q3');

Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');