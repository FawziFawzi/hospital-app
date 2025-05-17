<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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

Route::get('/home', [HomeController::class, 'redirect'])->middleware(['auth:sanctum','verified']);
Route::get('/', [HomeController::class, 'index'])->middleware('guest');

Route::post('/appointment', [ HomeController::class, 'appointment'])->name('user.appointment');
Route::get('/appointments', [ HomeController::class, 'appointments'])->middleware('auth')->name('user.appointments');
Route::delete('/appointment/{id}', [ HomeController::class, 'destroyAppointment'])->middleware('auth')->name('user.cancelAppointment');


Route::middleware(['auth:sanctum'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/add-doctor', [ AdminController::class, 'addDoctor'])->name('admin.add-doctor');
        Route::post('/store-doctor', [ AdminController::class, 'storeDoctor'])->name('admin.store-doctor');
        Route::get('/showappointment', [ AdminController::class, 'showAppointment'])->name('admin.showAppointment');
        Route::PATCH('/appointment/approve/{id}', [ AdminController::class, 'approveAppointment'])->name('admin.approveAppointment');
        Route::PATCH('/appointment/cancel/{id}', [ AdminController::class, 'cancelAppointment'])->name('admin.cancelAppointment');

        Route::get('/show-doctors', [ AdminController::class, 'showDoctors'])->name('admin.showDoctors');
        Route::delete('/delete-doctors/{id}', [ AdminController::class, 'deleteDoctors'])->name('admin.deleteDoctors');

        Route::get('/edit-doctors/{id}', [ AdminController::class, 'editDoctors'])->name('admin.editDoctors');
        Route::put('/update-doctors/{id}', [ AdminController::class, 'updateDoctors'])->name('admin.updateDoctors');

    });
