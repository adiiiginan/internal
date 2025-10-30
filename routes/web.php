<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\PerdinController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GudangController;

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

Route::get('/', function () {
    return view('welcome');
});

// Public permintaan/perdin routes (no auth required)
Route::get('/permintaan-barang', [PermintaanController::class, 'create'])
    ->name('permintaan.create');

Route::post('/permintaan-barang', [PermintaanController::class, 'store'])
    ->name('permintaan.store');

// Upload photo (camera) — saves image to storage, returns JSON { filename, url }
Route::post('/permintaan/upload-photo', [PermintaanController::class, 'uploadPhoto'])
    ->name('permintaan.upload_photo');

Route::get('/perdin', [PerdinController::class, 'create'])
    ->name('perdin.create');

Route::post('/perdin', [PerdinController::class, 'store'])
    ->name('perdin.store');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Admin PDF export for permintaan (requires auth)
    Route::get('/roles/admin/{id}/pdf', [PermintaanController::class, 'exportPdf'])
        ->name('roles.admin.pdf')->middleware('role:admin');

    // Legacy route name used in views: admin.permintaan.pdf
    Route::get('/admin/permintaan/{id}/pdf', [PermintaanController::class, 'exportPdf'])
        ->name('admin.permintaan.pdf')->middleware('role:admin');

    Route::get('/roles/barang-masuk', [App\Http\Controllers\BarangMasukController::class, 'index'])
        ->name('roles.gudang.masuk')->middleware('role:admin,sales,superadmin');

    Route::middleware(['auth', 'role:gudang'])->group(function () {
        Route::get('/gudang/dashboard', [GudangController::class, 'dashboard'])->name('gudang.dashboard');
        Route::post('/gudang/store', [GudangController::class, 'store'])->name('gudang.store');
    });

    // 🛡️ Route untuk User Kunjungan (role:2)
    Route::middleware(['auth', 'role:sales,superadmin'])->group(function () {
        Route::get('/sales/dashboard', [KunjunganController::class, 'dashboard'])->name('sales.dashboard');
        Route::post('/sales/store', [KunjunganController::class, 'store'])->name('sales.store');
    });

    // Finance (role:4)
    Route::middleware(['auth', 'role:finance,superadmin'])->group(function () {
        Route::get('/finance/perdin', [PerdinController::class, 'financeIndex'])->name('roles.finance.index');
        Route::get('/finance/perdin/approved', [PerdinController::class, 'approvedPerdin'])->name('roles.finance.approved');

        // PDF export for a perdin record
        Route::get('/finance/perdin/{id}/pdf', [PerdinController::class, 'pdf'])->name('roles.finance.pdf');

        // Approve / Reject actions for finance (and superadmin)
        Route::post('/finance/perdin/{id}/approve', [PerdinController::class, 'approve'])
            ->name('roles.finance.approve');
        Route::post('/finance/perdin/{id}/reject', [PerdinController::class, 'reject'])
            ->name('roles.finance.reject');
        Route::delete('/finance/perdin/{id}', [PerdinController::class, 'destroy'])
            ->name('roles.finance.destroy');
    });

    // Admin user management
    Route::get('/roles/users', [UserController::class, 'index'])
        ->name('roles.users.index');
    Route::get('/roles/users/create', [UserController::class, 'create'])
        ->name('roles.users.create');
    Route::post('/roles/users', [UserController::class, 'store'])
        ->name('roles.users.store');

    Route::get('/admin/permintaan/export-pdf', [PermintaanController::class, 'exportAllPdf'])
        ->name('admin.permintaan.exportPDF')->middleware('role:admin');

    Route::get('/admin/permintaan/export-excel', [PermintaanController::class, 'exportExcel'])
        ->name('admin.permintaan.exportExcel')->middleware('role:admin');

    Route::delete('/admin/permintaan/{id}', [PermintaanController::class, 'destroy'])
        ->name('admin.permintaan.destroy')->middleware('role:admin');

    Route::post('/admin/permintaan/{id}/update-status', [PermintaanController::class, 'updateStatus'])
        ->name('admin.permintaan.updateStatus')->middleware('role:admin');

    Route::get('/admin/permintaan/onprogress', [PermintaanController::class, 'onProgress'])
        ->name('admin.permintaan.onprogress')->middleware('role:admin');

    Route::get('/admin/permintaan/done', [PermintaanController::class, 'done'])
        ->name('admin.permintaan.done')->middleware('role:admin');

    Route::prefix('role')->group(function () {
        Route::get('superadmin', [RoleController::class, 'superadmin'])
            ->middleware('role:superadmin')
            ->name('role.superadmin');

        Route::get('admin', [RoleController::class, 'admin'])
            ->middleware('role:admin')
            ->name('role.admin');

        Route::get('sales', [RoleController::class, 'sales'])
            ->middleware('role:sales')
            ->name('role.sales');

        Route::get('finance', [RoleController::class, 'finance'])
            ->middleware('role:finance')
            ->name('role.finance');

        Route::get('gudang', [RoleController::class, 'gudang'])
            ->middleware('role:gudang')
            ->name('role.gudang');
    });
});
