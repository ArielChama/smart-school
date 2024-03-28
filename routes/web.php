<?php

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ClassificationsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\UsersController;
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

require __DIR__ . '/auth.php';


Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'home'])->name('dashboard');

    /*
        Rotas para estudantes
    */
    Route::prefix('students')->group(function () {
        Route::get('/list', [StudentsController::class, 'show'])->name('students.list');
        Route::get('/{id}/profile', [StudentsController::class, 'profile'])->name('students.profile');
        Route::get('/search', [StudentsController::class, 'search'])->name('students.search');

        Route::middleware(['admin'])->group(function () {
            Route::get('/add', [StudentsController::class, 'create'])->name('students.add');
            Route::post('/create', [StudentsController::class, 'store'])->name('students.store');
            Route::post('/{id}/delete', [StudentsController::class, 'delete'])->name('students.delete');
            Route::get('/{id}/edit', [StudentsController::class, 'edit'])->name('students.edit');
            Route::put('/{id}/update', [StudentsController::class, 'update'])->name('students.update');
        });
    });

    /*
        Rotas para professores
    */
    Route::prefix('teachers')->group(function () {
        Route::get('/list', [UsersController::class, 'show'])->name('teachers.list');
        Route::get('/{id}/profile', [UsersController::class, 'profile'])->name('teachers.profile');
        Route::get('/search', [UsersController::class, 'search'])->name('teachers.search');

        Route::middleware(['admin'])->group(function () {
            Route::get('/add', [UsersController::class, 'create'])->name('teachers.add');
            Route::post('/create', [UsersController::class, 'store'])->name('teachers.create');
            Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('teachers.edit');
            Route::post('/{id}/delete', [UsersController::class, 'delete'])->name('teachers.delete');
            Route::put('/{id}/update', [UsersController::class, 'update'])->name('teachers.update');

            Route::get('/{id}/lesson', [UsersController::class, 'lessons'])->name('teachers.lessons');
            Route::post('/{id}/lesson/create', [UsersController::class, 'addLesson'])->name('teachers.addLesson');
        });
    });

    /*
        Rotas para turmas
    */
    Route::prefix('classes')->group(function () {
        Route::get('/', [ClassesController::class, 'list'])->name('classes');
        Route::get('/{id}/info', [ClassesController::class, 'info'])->name('classes.info');
        Route::get('/{id}/classifications/create', [ClassesController::class, 'classifications'])->name('classes.classifications');
        Route::post('/{id}/classifications/store', [ClassificationsController::class, 'storeClassifications'])->name('classes.storeClassifications');

        Route::middleware(['admin'])->group(function () {
            Route::post('/{id}/delete', [ClassesController::class, 'delete'])->name('classes.delete');
            Route::post('student/{id}/delete', [ClassesController::class, 'deleteStudent'])->name('classe.students.delete');
            Route::get('/{id}/edit', [ClassesController::class, 'edit'])->name('classes.edit');
            Route::put('/{id}/update', [ClassesController::class, 'update'])->name('classes.update');
            Route::get('/{id}/insert', [ClassesController::class, 'insertStudent'])->name('classes.insert');
            Route::post('/{id}/matriculate', [ClassesController::class, 'matriculateStudent'])->name('classes.matriculate');
            Route::get('/{id}/teachers', [ClassesController::class, 'viewTeachers'])->name('classes.teachers');
            Route::post('/{id}/teachers/add', [UsersController::class, 'addTeacher'])->name('classes.addTeachers');
        });
    });

    /*
        Rotas para turmas
    */
    Route::prefix('classifications')->group(function () {
        Route::get('/', [ClassificationsController::class, 'list'])->name('classifications.list');
    });


    /*
        Rotas da página de configuração
    */
    Route::prefix('settings')->group(function () {
        Route::middleware(['admin'])->group(function () {
            Route::get('/academic', [SettingsController::class, 'academic'])->name('settings.academic');
            Route::post('/course_create', [SettingsController::class, 'storeCourse'])->name('settings.course');
            Route::post('/classe_create', [SettingsController::class, 'storeClasse'])->name('settings.classe');
            Route::post('/lesson_create', [SettingsController::class, 'storeLesson'])->name('settings.lesson');
            Route::post('/schoolYear_create', [SettingsController::class, 'storeSchoolYear'])->name('settings.schoolYear');
            Route::get('/schoolYear_select', [SettingsController::class, 'schoolYear'])->name('settings.schoolYear.select');
        });

        Route::get('/account', [SettingsController::class, 'account'])->name('settings.account');
        Route::put('/account/change-password', [SettingsController::class, 'changePassword'])->name('settings.change.password');
    });
});
