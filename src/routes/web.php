<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\TimestampController;
use App\Http\Controllers\AdminController;

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

Route::middleware('verified')->group(function () {
    Route::get('/attendance', [AttendanceController::class, 'index']);

    Route::get('/', [TimestampController::class, 'index']);
    Route::post('/timestamp', [TimestampController::class, 'store']);
    Route::patch('/timestamp/update', [TimestampController::class, 'update']);

    Route::post('/timestamp_rests', [RestController::class, 'store']);
    Route::patch('/timestamp_rests/update', [RestController::class, 'update']);

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::patch('/update/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::post('/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
        Route::get('/detail/{id}', [AdminController::class, 'show'])->name('admin.show');
    });
});

