<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdmissionController as AdminAdmissionController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\SchoolClassController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\StudentResultController;

/*
|--------------------------------------------------------------------------
| Public Website
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/admissions/apply', [AdmissionController::class, 'create'])
    ->name('admissions.create');

Route::post('/admissions/apply', [AdmissionController::class, 'store'])
    ->name('admissions.store');

Route::get('/admissions/confirmation/{admission}', [
    AdmissionController::class,
    'confirmation',
])->name('admissions.confirmation');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.store');
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Administrator Portal
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Admissions
        Route::get('/admissions', [
            AdminAdmissionController::class,
            'index',
        ])->name('admissions.index');

        Route::get('/admissions/{admission}', [
            AdminAdmissionController::class,
            'show',
        ])->name('admissions.show');

        Route::patch('/admissions/{admission}/status', [
            AdminAdmissionController::class,
            'updateStatus',
        ])->name('admissions.status');

        // Students
        Route::resource('students', StudentController::class)
            ->except(['destroy']);

        // Teachers
        Route::resource('teachers', TeacherController::class)
            ->except(['destroy']);

        Route::patch('/teachers/{teacher}/status', [
            TeacherController::class,
            'toggleStatus',
        ])->name('teachers.status');

        // Staff
        Route::resource('staff', StaffController::class)
            ->except(['destroy']);

        Route::patch('/staff/{staff}/status', [
            StaffController::class,
            'toggleStatus',
        ])->name('staff.status');

        // Classes
        Route::resource('classes', SchoolClassController::class)
            ->except(['destroy'])
            ->parameters(['classes' => 'schoolClass']);

        Route::patch('/classes/{schoolClass}/status', [
            SchoolClassController::class,
            'toggleStatus',
        ])->name('classes.status');

        // Subjects
        Route::resource('subjects', SubjectController::class)
            ->except(['destroy']);

        Route::patch('/subjects/{subject}/status', [
            SubjectController::class,
            'toggleStatus',
        ])->name('subjects.status');

        // Student Results and Grades
        Route::resource('results', StudentResultController::class)
            ->except(['destroy']);
    });
