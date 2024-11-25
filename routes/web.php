<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TableBookingController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tables', TableController::class);
Route::resource('table-bookings', TableBookingController::class);

Route::get('/admin', [AdminController::class, 'index']);

Route::get('/admin/table/create_table', [AdminController::class, 'create_table']);
Route::post('/admin/table/create_table', [TableController::class, 'store']);

Route::get('/admin/table/{id}', [TableController::class, 'show'])->name('table.show');

Route::get('/admin/table/{id}/edit', [TableController::class, 'edit'])->name('table.edit');
Route::put('/admin/table/{id}', [TableController::class, 'update'])->name('table.update');

Route::delete('/admin/table/{id}', [TableController::class, 'destroy'])->name('table.destroy');