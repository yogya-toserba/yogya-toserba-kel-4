<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Supplier Routes
|--------------------------------------------------------------------------
|
| Routes untuk sistem supplier/pemasok
|
*/

// Auth routes untuk supplier
Route::get('/login', [SupplierController::class, 'login'])->name('supplier.login');
Route::post('/login', [SupplierController::class, 'authenticate'])->name('supplier.authenticate');

// Protected routes untuk supplier (perlu login)
Route::middleware('auth:pemasok')->group(function () {
  // Dashboard
  Route::get('/dashboard', [SupplierController::class, 'dashboard'])->name('supplier.dashboard');

  // Profile
  Route::get('/profile', [SupplierController::class, 'profile'])->name('supplier.profile');
  Route::put('/profile', [SupplierController::class, 'updateProfile'])->name('supplier.profile.update');

  // Chat
  Route::get('/chat/{roomId}', [SupplierController::class, 'chatShow'])->name('supplier.chat.show');
  Route::post('/chat/{roomId}/message', [SupplierController::class, 'sendMessage'])->name('supplier.chat.message');

  // Logout
  Route::post('/logout', [SupplierController::class, 'logout'])->name('supplier.logout');
});
