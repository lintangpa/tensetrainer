<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminKelolaAchievementController;
use App\Http\Controllers\AdminKelolaAkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PastContinuousController;
use App\Http\Controllers\PresentContinuousController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SimpleFutureController;
use App\Http\Controllers\SimplePastController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
    Route::get('/admin-kelola-akun', [AdminKelolaAkunController::class, 'index'])->name('admin-kelola-akun');
    Route::get('/users/{id}', [AdminKelolaAkunController::class, 'findId']);
    Route::delete('/usersDelete/{id}', [AdminKelolaAkunController::class, 'destroy']);
    Route::put('/usersDetail/{id}', [AdminKelolaAkunController::class, 'updateDetail'])->name('updateDetailAkun');
    Route::get('/admin-kelola-achievement', [AdminKelolaAchievementController::class, 'index'])->name('admin-kelola-achievement');
    Route::get('/achievement/{id}', [AdminKelolaAchievementController::class, 'findId']);
    Route::put('/achievementDetail/{id}', [AdminKelolaAchievementController::class, 'updateDetail'])->name('updateDetail');
    Route::delete('/achievementDelete/{id}', [AdminKelolaAchievementController::class, 'destroy']);
    Route::post('/achievementTambah', [AdminKelolaAchievementController::class, 'store'])->name('achievementTambah');
});

Route::group(['middleware' => ['auth', 'studentadmin']], function () {
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');
});

Route::group(['middleware' => ['auth', 'student']], function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/simple-present', [SimplePresentController::class, 'index'])->name('simple-present');
    Route::get('/simple-present-quest1', [SimplePresentController::class, 'quest1'])->name('simple-present-quest1');
    Route::get('/simple-present-quest2', [SimplePresentController::class, 'quest2'])->name('simple-present-quest2');
    Route::get('/simple-present-quest3', [SimplePresentController::class, 'quest3'])->name('simple-present-quest3');

    Route::get('/present-continuous', [PresentContinuousController::class, 'index'])->name('present-continuous');
    Route::get('/present-continuous-quest1', [PresentContinuousController::class, 'quest1'])->name('present-continuous-quest1');
    Route::get('/present-continuous-quest2', [PresentContinuousController::class, 'quest2'])->name('present-continuous-quest2');
    Route::get('/present-continuous-quest3', [PresentContinuousController::class, 'quest3'])->name('present-continuous-quest3');

    Route::get('/simple-past', [SimplePastController::class, 'index'])->name('simple-past');
    Route::get('/simple-past-quest1', [SimplePastController::class, 'quest1'])->name('simple-past-quest1');
    Route::get('/simple-past-quest2', [SimplePastController::class, 'quest2'])->name('simple-past-quest2');
    Route::get('/simple-past-quest3', [SimplePastController::class, 'quest3'])->name('simple-past-quest3');

    Route::get('/past-continuous', [PastContinuousController::class, 'index'])->name('past-continuous');
    Route::get('/past-continuous-quest1', [PastContinuousController::class, 'quest1'])->name('past-continuous-quest1');
    Route::get('/past-continuous-quest2', [PastContinuousController::class, 'quest2'])->name('past-continuous-quest2');
    Route::get('/past-continuous-quest3', [PastContinuousController::class, 'quest3'])->name('past-continuous-quest3');

    Route::get('/simple-future', [SimpleFutureController::class, 'index'])->name('simple-future');
    Route::get('/simple-future-quest1', [SimpleFutureController::class, 'quest1'])->name('simple-future-quest1');
    Route::get('/simple-future-quest2', [SimpleFutureController::class, 'quest2'])->name('simple-future-quest2');
    Route::get('/simple-future-quest3', [SimpleFutureController::class, 'quest3'])->name('simple-future-quest3');

    Route::post('/add-exp', [ExpController::class, 'addExp'])->name('addexp');
    Route::get('/get-karma', [ExpController::class, 'getKarma'])->name('getKarma');

    Route::post('/updateprogress1Q1', [ExpController::class, 'updateProgress1Q1'])->name('updateprogress1Q1');
    Route::post('/updateprogress1Q2', [ExpController::class, 'updateProgress1Q2'])->name('updateprogress1Q2');
    Route::post('/updateprogress1Q3', [ExpController::class, 'updateProgress1Q3'])->name('updateprogress1Q3');

    Route::post('/updateprogress2Q1', [ExpController::class, 'updateProgress2Q1'])->name('updateprogress2Q1');
    Route::post('/updateprogress2Q2', [ExpController::class, 'updateProgress2Q2'])->name('updateprogress2Q2');
    Route::post('/updateprogress2Q3', [ExpController::class, 'updateProgress2Q3'])->name('updateprogress2Q3');

    Route::post('/updateprogress3Q1', [ExpController::class, 'updateProgress3Q1'])->name('updateprogress3Q1');
    Route::post('/updateprogress3Q2', [ExpController::class, 'updateProgress3Q2'])->name('updateprogress3Q2');
    Route::post('/updateprogress3Q3', [ExpController::class, 'updateProgress3Q3'])->name('updateprogress3Q3');

    Route::post('/updateprogress4Q1', [ExpController::class, 'updateProgress4Q1'])->name('updateprogress4Q1');
    Route::post('/updateprogress4Q2', [ExpController::class, 'updateProgress4Q2'])->name('updateprogress4Q2');
    Route::post('/updateprogress4Q3', [ExpController::class, 'updateProgress4Q3'])->name('updateprogress4Q3');

    Route::post('/updateprogress5Q1', [ExpController::class, 'updateProgress5Q1'])->name('updateprogress5Q1');
    Route::post('/updateprogress5Q2', [ExpController::class, 'updateProgress5Q2'])->name('updateprogress5Q2');
    Route::post('/updateprogress5Q3', [ExpController::class, 'updateProgress5Q3'])->name('updateprogress5Q3');
});
