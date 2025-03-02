<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ProfessionsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UsedController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get("/auth", [AuthController::class, 'index'])->name('login')->middleware('user-web');

Route::get("/", [HomeController::class, "index"])->name('home')->middleware('user-web');
Route::group(['prefix' => 'professions', 'as' => 'professions.', 'middleware' => 'user-web'], function () {
    Route::get("/", [ProfessionsController::class, 'index'])->name('index');
    Route::get("/add", [ProfessionsController::class, 'create'])->name('create');
    Route::get("/edit/{profession}", [ProfessionsController::class, 'edit'])->name('edit');
});

Route::group(['prefix' => 'items', 'as' => 'items.', 'middleware' => 'user-web'], function () {
    Route::get("/", [ItemsController::class, 'index'])->name('index');
    Route::get("/add", [ItemsController::class, 'create'])->name('create');
    Route::get("/edit/{item}", [ItemsController::class, 'edit'])->name('edit');
});

Route::group(['prefix' => 'employees', 'as' => 'employees.', 'middleware' => 'user-web'], function () {
    Route::get("/", [EmployeesController::class, 'index'])->name('index');
    Route::get("/add", [EmployeesController::class, 'create'])->name('create');
    Route::get("/edit/{employee}", [EmployeesController::class, 'edit'])->name('edit');
});

Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => ['user-web', 'role-web:admin']], function () {
    Route::get("/", [UsersController::class, 'index'])->name('index');
    Route::get("/edit/{user}", [UsersController::class, 'edit'])->name('edit');
    Route::get('/add', [UsersController::class, 'create'])->name('create');
});

Route::group(['prefix' => "departments", 'as' => 'departments.', 'middleware' => ['user-web']], function () {
    Route::get("/", [DepartmentsController::class, 'index'])->name('index');
    Route::get("/add", [DepartmentsController::class, 'create'])->name('create');
    Route::get("/edit/{department}", [DepartmentsController::class, 'edit'])->name('edit');
});

Route::group(['prefix' => "used", 'as' => 'used.', 'middleware' => ['user-web']], function () {
    Route::get("/", [UsedController::class, 'index'])->name('index');
});

Route::group(['prefix' => 'reports', 'as' => 'reports.', 'middleware' => ['user-web']], function () {
    Route::get('/statement', [ReportController::class, 'statement'])->name('statement');
    Route::get('/order', [ReportController::class, 'order'])->name('statement');
    Route::get('/employee/{employee}', [ReportController::class, 'employee'])->name('employee');
    Route::get("/back/{employee}", [ReportController::class, 'employeeBack'])->name('employee-back');
});

Route::get("/logout", [UsersController::class, 'logout'])->name('logout')->middleware(['user-web']);
