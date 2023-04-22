<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeProjectController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth.session')->group(function () {
    // companies
    Route::post('/api/comapnies/create/', [CompanyController::class, 'store'])->name('api.companies.create');
    Route::post('/api/comapnies/edit/{id}', [CompanyController::class, 'update'])->name('api.companies.edit');
    Route::post('/api/comapnies/delete/', [CompanyController::class, 'destroy'])->name('api.companies.delete');

    // projects
    Route::post('/api/projects/create/', [ProjectController::class, 'store'])->name('api.projects.create');
    Route::post('/api/projects/edit/{id}', [ProjectController::class, 'update'])->name('api.projects.edit');
    Route::post('/api/projects/delete/', [ProjectController::class, 'destroy'])->name('api.projects.delete');

    // employees
    Route::post('/api/employees/create/', [EmployeeController::class, 'store'])->name('api.employees.create');
    Route::post('/api/employees/edit/{id}', [EmployeeController::class, 'update'])->name('api.employees.edit');
    Route::post('/api/employees/delete/', [EmployeeController::class, 'destroy'])->name('api.employees.delete');

    // employees projects
    Route::post('/api/employees/project/create/', [EmployeeProjectController::class, 'store'])->name('api.employees.projects.create');
    Route::post('/api/employees/project/edit/{id}', [EmployeeProjectController::class, 'update'])->name('api.employees.projects.edit');
    Route::post('/api/employees/project/delete/', [EmployeeProjectController::class, 'destroy'])->name('api.employees.projects.delete');
});
