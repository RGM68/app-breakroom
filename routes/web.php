<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TableBookingController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodAndDrinkController;
use App\Http\Controllers\WaitingListController;
use App\Http\Controllers\LoyaltyProgramController;

Route::get('/', function () {
    return view('welcome');
});

//TABLES
Route::resource('tables', TableController::class);
Route::resource('table-bookings', TableBookingController::class);

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::get('/admin/table/create_table', [AdminController::class, 'create_table']);
Route::post('/admin/table/create_table', [TableController::class, 'store']);

Route::get('/admin/tables', [TableController::class, 'index'])->name('table.index');
Route::get('/admin/table/{id}', [TableController::class, 'show'])->name('table.show');

Route::get('/admin/table/{id}/edit', [TableController::class, 'edit'])->name('table.edit');
Route::get('/admin/table/{id}/change_image', [TableController::class, 'changeImage'])->name('table.changeImage');
Route::put('/admin/table/{id}', [TableController::class, 'update'])->name('table.update');
Route::put('/admin/table/{id}/status', [TableController::class, 'updateStatus'])->name('table.updateStatus');
Route::put('/admin/table/{id}/change_image', [TableController::class, 'updateImage'])->name('table.updateImage');

Route::delete('/admin/table/{id}', [TableController::class, 'destroy'])->name('table.destroy');

// Event Routes
// ADMIN
Route::get('/admin/events', [EventController::class, 'adminIndex'])->name('event.adminIndex');
Route::get('/admin/event/create_event', [AdminController::class, 'create_event'])->name('event.create');
Route::post('/admin/event/create_event', [EventController::class, 'store'])->name('event.store');

Route::get('/admin/event/{id}', [EventController::class, 'show'])->name('event.show');
Route::put('/admin/event/{id}/status', [EventController::class, 'updateStatus'])->name('event.updateStatus');
Route::get('/admin/event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
Route::get('/admin/event/{id}/change_image', [EventController::class, 'changeImage'])->name('event.changeImage');
Route::put('/admin/event/{id}', [EventController::class, 'update'])->name('event.update');
Route::put('/admin/event/{id}/change_image', [EventController::class, 'updateImage'])->name('event.updateImage');

Route::delete('/admin/event/{id}', [EventController::class, 'destroy'])->name('event.destroy');

//USER
Route::post('/events/{event}/register', [EventController::class, 'register'])->name('event.register');

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');


// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Booking Routes
Route::get('/bookings/check', [BookingController::class, 'checkAvailability'])->name('bookings.check');
Route::post('/bookings', [BookingController::class, 'book'])->name('bookings.book');
Route::get('/bookings/history', [BookingController::class, 'history'])->name('bookings.history');

// User Routes
Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Food & Drink Routes
    Route::get('/food-and-drinks', [FoodAndDrinkController::class, 'index'])->name('food-and-drinks.index');
    Route::post('/food-and-drinks/order', [FoodAndDrinkController::class, 'order'])->name('food-and-drinks.order');

    // Waiting List Routes
    Route::get('/waiting-list', [WaitingListController::class, 'index'])->name('waiting-list.index');
    Route::post('/waiting-list/join', [WaitingListController::class, 'join'])->name('waiting-list.join');

    // Loyalty Program Routes
    Route::get('/loyalty-program', [LoyaltyProgramController::class, 'index'])->name('loyalty-program.index');

    // Booking History Routes
    Route::get('/booking-history', [BookingController::class, 'history'])->name('booking-history.index');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Table Management
    Route::get('/tables/status', [TableController::class, 'status'])->name('admin.tables.status');
    Route::put('/tables/{table}/update-status', [TableController::class, 'updateStatus'])->name('admin.tables.update-status');

    // Event Management
    Route::get('/events/manage', [EventController::class, 'manage'])->name('admin.events.manage');

    // Product Management
    Route::get('/products/manage', [ProductController::class, 'manage'])->name('admin.products.manage');

    // Food & Drink Management
    Route::get('/food-and-drinks/manage', [FoodAndDrinkController::class, 'manage'])->name('admin.food-and-drinks.manage');

    // User Management
    Route::get('/users', [AdminController::class, 'userList'])->name('admin.users.index');
    Route::get('/users/{user}/reset-password', [AdminController::class, 'resetPassword'])->name('admin.users.reset-password');

    // Waiting List Management
    Route::get('/waiting-list/manage', [WaitingListController::class, 'manage'])->name('admin.waiting-list.manage');
});