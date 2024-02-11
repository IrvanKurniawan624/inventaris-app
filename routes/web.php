<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Apps\BarangController;
use App\Http\Controllers\Apps\KategoriController;
use App\Http\Controllers\Apps\PeminjamController;
use App\Http\Controllers\Apps\RuangController;
use App\Http\Controllers\Apps\SupplierController;
use App\Http\Controllers\Laporan\LaporanPinjamanController;
use App\Http\Controllers\Pinjam\PinjamController;
use App\Http\Controllers\Transaksi\TransaksiController;

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

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::group(['middleware' => 'cek_login'], function () {
    Route::get('/', function () {
        return Redirect::to('/dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/get-data', [DashboardController::class, 'get_data']);

    Route::prefix('apps')->group(function(){
        Route::prefix('barang')->group(function(){
            Route::get('/', [BarangController::class, 'index'])->name('barang');
            Route::get('datatables', [BarangController::class, 'datatables']);
            Route::get('detail/{id}', [BarangController::class, 'detail']);
            Route::post('store-update', [BarangController::class, 'store_update']);
            Route::get('print-pdf', [BarangController::class, 'print_pdf']);
            Route::delete('delete/{id}', [BarangController::class, 'delete']);
        });

        Route::prefix('kategori')->group(function(){
            Route::get('/', [KategoriController::class, 'index'])->name('kategori');
            Route::get('datatables', [KategoriController::class, 'datatables']);
            Route::get('detail/{id}', [KategoriController::class, 'detail']);
            Route::post('store-update', [KategoriController::class, 'store_update']);
            Route::delete('delete/{id}', [KategoriController::class, 'delete']);
        });

        Route::prefix('supplier')->group(function(){
            Route::get('/', [SupplierController::class, 'index'])->name('supplier');
            Route::get('datatables', [SupplierController::class, 'datatables']);
            Route::get('detail/{id}', [SupplierController::class, 'detail']);
            Route::post('store-update', [SupplierController::class, 'store_update']);
            Route::delete('delete/{id}', [SupplierController::class, 'delete']);
        });

        Route::prefix('peminjam')->group(function(){
            Route::get('/', [PeminjamController::class, 'index'])->name('peminjam');
            Route::get('datatables', [PeminjamController::class, 'datatables']);
            Route::get('detail/{id}', [PeminjamController::class, 'detail']);
            Route::post('store-update', [PeminjamController::class, 'store_update']);
            Route::delete('delete/{id}', [PeminjamController::class, 'delete']);
        });

        Route::prefix('ruang')->group(function(){
            Route::get('/', [RuangController::class, 'index'])->name('ruang');
            Route::get('datatables', [RuangController::class, 'datatables']);
            Route::get('detail/{id}', [RuangController::class, 'detail']);
            Route::post('store-update', [RuangController::class, 'store_update']);
            Route::delete('delete/{id}', [RuangController::class, 'delete']);
        });
    });

    Route::prefix('transaksi')->group(function(){ 
        Route::prefix('barang-masuk')->group(function(){
            Route::get('/', [TransaksiController::class, 'index_barang_masuk'])->name('transaksi.barang_masuk');
            Route::get('/get-select2-data', [TransaksiController::class, 'getBarangMasukSelect2Data']);
            Route::post('/store-transaksi', [TransaksiController::class, 'barang_masuk_transaksi']);
        });

        Route::prefix('barang-keluar')->group(function(){
            Route::get('/', [TransaksiController::class, 'index_barang_keluar'])->name('transaksi.barang_keluar');
            Route::get('/get-select2-data', [TransaksiController::class, 'getBarangKeluarSelect2Data']);
            Route::post('/store-transaksi', [TransaksiController::class, 'barang_keluar_transaksi']);
        });
    });

    Route::prefix('pinjam')->group(function(){
        Route::get('/', [PinjamController::class, 'index'])->name('pinjam');
        Route::get('/datatables', [PinjamController::class, 'datatables']);
        Route::post('/store-pinjam', [PinjamController::class, 'store_pinjam']);

        Route::prefix('pengembalian')->group(function(){
            Route::get('/', [PinjamController::class, 'index_pengembalian'])->name('pengembalian');
            Route::get('/datatables', [PinjamController::class, 'datatables_pengembalian']);
            Route::get('/detail/{id}', [PinjamController::class, 'detail_pengembalian']);
            Route::post('/store-pengembalian', [PinjamController::class, 'store_pengembalian']);
        });
    });

    Route::prefix('laporan')->group(function(){ 
        Route::prefix('pinjaman')->group(function(){
            Route::get('/', [LaporanPinjamanController::class, 'index'])->name('laporan.pinjam');
            Route::get('datatables', [LaporanPinjamanController::class, 'datatables']);
            Route::get('detail/{id}', [LaporanPinjamanController::class, 'detail']);
            Route::get('print-pdf', [LaporanPinjamanController::class, 'print_pdf']);
        });
    });

    Route::view('about', 'about.index')->name('about');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
