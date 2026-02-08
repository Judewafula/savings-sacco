<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ProfitController;
use App\Http\Controllers\UserController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Auth::routes();

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');

// Email verification
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

// Password reset
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Test reset link
Route::get('/test-reset', function () {
    $email = 'judewafula52@gmail.com';
    $status = Password::sendResetLink(['email' => $email]);
    return $status === Password::RESET_LINK_SENT ? '✅ Reset link sent.' : '❌ Failed to send.';
});

// Admin login (public)
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

// 🔐 All routes below are protected by auth middleware
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Members
    Route::get('/members', [MembersController::class, 'index']);
    Route::post('/members', [MembersController::class, 'store']);
    Route::get('/members/{id}', [MembersController::class, 'show']);

    // Transactions
    Route::get('/transactions', [TransactionsController::class, 'index']);
    Route::post('/transactions', [TransactionsController::class, 'store']);

    // Accounts
    Route::get('/accounts', [AccountsController::class, 'index']);
    Route::post('/accounts', [AccountsController::class, 'store']);

    // Assets
    Route::get('/assets/dashboard', [AssetController::class, 'dashboard'])->name('assets.dashboard');
    Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');
    Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create');
    Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');
    Route::get('/assets/{id}/edit', [AssetController::class, 'edit'])->name('assets.edit');
    Route::put('/assets/{id}', [AssetController::class, 'update'])->name('assets.update');
    Route::delete('/assets/{id}', [AssetController::class, 'destroy'])->name('assets.destroy');
    Route::get('/assets/{id}/select', [AssetController::class, 'select'])->name('assets.select');
    Route::post('/assets/{id}/confirm-selection', [AssetController::class, 'confirmSelection'])->name('assets.confirmSelection');

    // Sales
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/create/{asset_id?}', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');

    // Profit
    Route::get('/profit', [ProfitController::class, 'index'])->name('profit');

    // Profile
    Route::get('/profile', [UserController::class, 'profile']);

    // Admin dashboard (requires both auth + admin middleware)
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
        Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    });
});

// Test route
Route::get('/test', function () {
    return view('test');
});


Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    // other user management routes only for admin
});
