<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BigDataController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\InvalidDataController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\KepalaCabang\DashboardController as KepalaCabangDashboardController;
use App\Http\Controllers\KepalaCabang\LaporanController as KepalaCabangLaporanController;
use App\Http\Controllers\KepalaCabang\UserManagementController as KepalaCabangUserManagementController;
use App\Http\Controllers\Supervisor\DashboardController as SupervisorDashboardController;
use App\Http\Controllers\Supervisor\LaporanController as SupervisorLaporanController;
use App\Http\Controllers\Salesman\DashboardController as SalesmanDashboardController;
use App\Http\Controllers\Salesman\LaporanController as SalesmanLaporanController;
use App\Http\Controllers\Salesman\SavedDataController as SalesmanSavedDataController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth
Route::controller(AuthController::class)->group(function () {
    Route::get('/login-user', 'index')->name('login'); // Login
    Route::post('/login', 'login')->name('login.action');
    Route::post('logout', 'logout')->middleware('auth')->name('logout'); // Logout
});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); // Dashboard

    // big data
    Route::get('/big-data', [BigDataController::class, 'index'])->name('bigdata'); // Big Data
    Route::post('/customer', [BigDataController::class, 'store'])->name('customer.store'); // create
    Route::delete('/customer/{id}', [BigDataController::class, 'destroy'])->name('customer.destroy'); // Delete
    Route::post('/big-data/upload', [BigDataController::class, 'upload'])->name('bigdata.upload'); //import

    // invalid data
    Route::get('/invalid-data', [InvalidDataController::class, 'index'])->name('invaliddata'); // Invalid Data
    Route::delete('/invalid-customer/{id}', [InvalidDataController::class, 'destroy'])->name('invaliddata.customer.destroy'); // Delete

    // laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan'); // Laporan
    Route::post('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');

    // manage user
    Route::get('/user-management', [UserManagementController::class, 'index'])->name('usermanagement'); // user management
    Route::post('/user', [UserManagementController::class, 'store'])->name('user.store'); // create
    Route::put('/user/{id}', [UserManagementController::class, 'update'])->name('user.update'); // update
    Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('user.delete'); // delete

});

// Kepala Cabang
Route::middleware(['auth', 'role:kepala_cabang'])->prefix('kepala_cabang')->name('kacab.')->group(function () {

    // dashboard
    Route::get('/', [KepalaCabangDashboardController::class, 'index'])->name('dashboard'); // Dashboard

    // laporan
    Route::get('/laporan', [KepalaCabangLaporanController::class, 'index'])->name('laporan'); // Laporan
    Route::post('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');

    // manage user
    Route::get('/user-management', [KepalaCabangUserManagementController::class, 'index'])->name('usermanagement'); // user management
    Route::post('/user', [KepalaCabangUserManagementController::class, 'store'])->name('user.store'); // create
    Route::put('/user/{id}', [KepalaCabangUserManagementController::class, 'update'])->name('user.update'); // update
    Route::delete('/users/{id}', [KepalaCabangUserManagementController::class, 'destroy'])->name('user.delete'); // delete
});

// Supervisor
Route::middleware(['auth', 'role:supervisor'])->prefix('supervisor')->name('supervisor.')->group(function () {

    // dashboard
    Route::get('/', [SupervisorDashboardController::class, 'index'])->name('dashboard'); // Dashboard

    // manage user
    Route::get('/laporan', [SupervisorLaporanController::class, 'index'])->name('laporan'); // Laporan
    Route::post('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
});

// Salesman
Route::middleware(['auth', 'role:salesman'])->prefix('salesman')->name('salesman.')->group(function () {

    // dashboard
    Route::get('/', [SalesmanDashboardController::class, 'index'])->name('dashboard'); // Dashboard
    Route::post('/customer/save/{id}', [SalesmanDashboardController::class, 'saveCustomer'])->name('customer.save');

    // saved cust
    Route::get('/saved-customer', [SalesmanSavedDataController::class, 'index'])->name('saved-customer'); // Saved Data
    Route::post('/customer', [SalesmanSavedDataController::class, 'store'])->name('customer.store'); // create
    Route::put('/customer/{id}', [SalesmanSavedDataController::class, 'update'])->name('customer.update'); // update

    // laporan
    Route::get('/laporan', [SalesmanLaporanController::class, 'index'])->name('laporan'); // Laporan
});


