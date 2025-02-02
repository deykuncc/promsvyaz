<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DepartmentsController;
use App\Http\Controllers\Api\EmployeesController;
use App\Http\Controllers\Api\ItemsController;
use App\Http\Controllers\Api\UsedController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfessionsController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
});

// TODO middleware на админа и на авторизацию
Route::group(['prefix' => 'users'], function () {
    Route::post('/', [UsersController::class, 'store']);
    Route::put('/{user}', [UsersController::class, 'update']);
    Route::delete("/{user}", [UsersController::class, 'destroy']);
});

Route::group(['prefix' => 'items'], function () {
    Route::get("/", [ItemsController::class, 'index']);
    Route::post('/', [ItemsController::class, 'store']);
    Route::put('/{item}', [ItemsController::class, 'update']);
    Route::delete('/{item}', [ItemsController::class, 'destroy']);
});

Route::group(['prefix' => 'professions'], function () {
    Route::post('/', [ProfessionsController::class, 'store']);
    Route::put('/{profession}', [ProfessionsController::class, 'update']);
    Route::delete('/{profession}', [ProfessionsController::class, 'destroy']);
    Route::get('/{profession}/items', [ProfessionsController::class, 'items']);
});

Route::group(['prefix' => 'employees'], function () {
    Route::post('/', [EmployeesController::class, 'store']);
    Route::post('/{employee}/items', [EmployeesController::class, 'updateItems']);
    Route::put('/{employee}', [EmployeesController::class, 'update']);
    Route::delete('/{employee}', [EmployeesController::class, 'destroy']);
});

Route::group(['prefix' => 'departments'], function () {
    Route::post('/', [DepartmentsController::class, 'store']);
    Route::put('/{department}', [DepartmentsController::class, 'update']);
    Route::delete('/{department}', [DepartmentsController::class, 'destroy']);
});

Route::group(['prefix' => "used"], function () {
    Route::patch("/{id}/received", [UsedController::class, 'receivedChange']);
    Route::put("/{id}", [UsedController::class, 'update']);
});
