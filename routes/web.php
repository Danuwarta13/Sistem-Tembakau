<?php

use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotaController;
use App\Livewire\Admin\Dashboard as DashboardAdmin;
use App\Livewire\Admin\KeranjangAdmin;
use App\Livewire\Admin\PenyetorAdmin;
use App\Livewire\Operator\Dashboard as DashboardOperator;
use App\Livewire\Operator\KeranjangOperator;
use App\Livewire\Operator\LaporanOperator;
use App\Livewire\Operator\PenyetorOperator;

Route::get('/', Login::class)->name('login');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', DashboardAdmin::class)->name('admin.dashboard');
    Route::get('/admin/keranjang', KeranjangAdmin::class)->name('admin.keranjang');
    Route::get('/admin/penyetor', PenyetorAdmin::class)->name('admin.penyetor');
    Route::get('/admin/keranjang/nota/cetak/{penyetor}/{tanggal}', [NotaController::class, 'cetak'])->name('admin.nota.cetak');
});
Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/operator/dashboard', DashboardOperator::class)->name('operator.dashboard');
    Route::get('/operator/keranjang', KeranjangOperator::class)->name('operator.keranjang');
    Route::get('/operator/penyetor', PenyetorOperator::class)->name('operator.penyetor');
    Route::get('/operator/laporan', LaporanOperator::class)->name('operator.laporan');
    Route::get('/operator/keranjang/nota/cetak/{penyetor}/{tanggal}', [NotaController::class, 'cetak'])->name('operator.nota.cetak');
});


// Logout route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');
