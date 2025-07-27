<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('products', ProductController::class);
    Route::get('products/{product}/history', [ProductController::class, 'show'])->name('products.history');
    Route::resource('invoices', InvoiceController::class);
    Route::get('/laporan/penjualan', [ReportController::class, 'penjualan'])->name('report.penjualan');
    Route::get('/laporan/penjualan/{id}', [ReportController::class, 'show'])->name('report.penjualan.show');
    Route::get('/laporan/penjualan/export/pdf', [ReportController::class, 'exportPdf'])->name('report.penjualan.pdf');
    Route::get('/laporan/penjualan/export/excel', [ReportController::class, 'exportExcel'])->name('report.penjualan.excel');
});

require __DIR__ . '/auth.php';
