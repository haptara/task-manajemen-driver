<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskdriverController;
use App\Http\Controllers\VehiclesController;
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
    return view('welcome');
});

Route::get('/e-driver',[TaskdriverController::class,'index'])->name('driver');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // DRIVER
    Route::get('/driver', [DriverController::class, 'index'])->name('driver');
    Route::post('/driver/add', [DriverController::class, 'store'])->name('driver.add');

    // VEHICLES
    Route::get('/vehicles', [VehiclesController::class, 'index'])->name('vehicles');
    Route::post('/vehicles/add', [VehiclesController::class, 'store'])->name('vehicle.add');

    // TASK
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    Route::post('/task/update-progress', [TaskController::class, 'updateStatus'])->name('update-status');
    Route::delete('/task/delete-task', [TaskController::class, 'destroy'])->name('delete-task');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
