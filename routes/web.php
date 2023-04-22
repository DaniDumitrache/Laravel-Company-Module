<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeProjectController;
use App\Http\Controllers\ProjectController;
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

Route::get('/', function () {
    return view('index');
});

Route::middleware('auth')->group(function () {
    // companies
    Route::resource('/companies/', CompanyController::class)->names([
        'index' => 'companies.index',
        'create' => 'companies.create'
    ]);
    Route::get('/companies/edit/{id}', [CompanyController::class, 'edit'])->name('companies.edit');

    // employees
    Route::resource('/employees/', EmployeeController::class)->names([
        'index' => 'employees.index',
        'create' => 'employees.create',
    ]);
    Route::get('/employees/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');

    // projects
    Route::resource('/projects/', ProjectController::class)->names([
        'index' => 'projects.index',
        'create' => 'projects.create'
    ]);
    Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])->name('companies.edit');

    // employees projects
    Route::resource('/employees/projects/', EmployeeProjectController::class)->names([
        'index' => 'employees.projects.index',
        'create' => 'employees.projects.create'
    ]);
    Route::get('/employees/projects/edit/{id}', [EmployeeProjectController::class, 'edit'])->name('employees.projects.edit');
});
Auth::routes();
