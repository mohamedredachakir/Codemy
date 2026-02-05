<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\AssignController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});



Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    Route::resource('users', UserController::class);
});


Route::resource('classes', ClassController::class);
Route::resource('sprints', SprintController::class);
Route::resource('competences', CompetenceController::class);


Route::middleware(['auth'])->group(function() {
    Route::get('/assign', [AssignController::class, 'index'])->name('assign.index');
    Route::post('/assign/teacher', [AssignController::class, 'assignTeacher'])->name('assign.teacher');
    Route::post('/assign/student', [AssignController::class, 'assignStudent'])->name('assign.student');
});
