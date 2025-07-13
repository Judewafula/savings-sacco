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
use App\Http\Controllers\ProfitController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [AssetController::class, 'dashboard'])->name('dashboard');
Route::get('/assets/dashboard', [AssetController::class, 'dashboard'])->name('assets.dashboard');

Route::get('/members', [MembersController::class, 'index']);
Route::post('/members', [MembersController::class, 'store']);
Route::get('/members/{id}', [MembersController::class, 'show']);

Route::get('/transactions', [TransactionsController::class, 'index']);
Route::post('/transactions', [TransactionsController::class, 'store']);

Route::get('/accounts', [AccountsController::class, 'index']);
Route::post('/accounts', [AccountsController::class, 'store']);

// Auth routes (only one call)
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin routes with middleware and class-based syntax
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
});

Route::get('/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');
Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create');
Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');
Route::get('/assets/{id}/edit', [AssetController::class, 'edit'])->name('assets.edit');
Route::put('/assets/{id}', [AssetController::class, 'update'])->name('assets.update');
Route::delete('/assets/{id}', [AssetController::class, 'destroy'])->name('assets.destroy');
Route::get('assets/{id}/select', [AssetController::class, 'select'])->name('assets.select');
Route::post('assets/{id}/confirm-selection', [AssetController::class, 'confirmSelection'])->name('assets.confirmSelection');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');

// Sales routes - only one POST route kept and duplicates removed
Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
Route::get('/sales/create/{asset_id?}', [SaleController::class, 'create'])->name('sales.create');
Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');

// Profit route
Route::get('/profit', [ProfitController::class, 'index'])->name('profit');

// Test route
Route::get('/test', function () {
    return view('test');
});

// Password reset routes (explicitly defined for clarity)
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Test reset link sending via code
Route::get('/test-reset', function () {
    $email = 'judewafula52@gmail.com'; // your registered email

    $status = Password::sendResetLink(['email' => $email]);

    if ($status === Password::RESET_LINK_SENT) {
        return '✅ Reset link sent to ' . $email;
    }

    Log::error('❌ Password reset failed. Status: ' . $status);
    return '❌ Failed to send reset link. Status: ' . $status;
});
