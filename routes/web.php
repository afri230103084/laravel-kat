<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OnlineController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [OnlineController::class, 'beranda'])->name('user-beranda');
Route::get('u_about', [OnlineController::class, 'about'])->name('user-about');
Route::get('u_kategori', [OnlineController::class, 'kategori'])->name('user-kategori');
Route::get('u_menu', [OnlineController::class, 'menu'])->name('user-menu');

Route::get('login', [AuthController::class, 'loginPage'])->name('login');
Route::post('login-process', [AuthController::class, 'loginProcess'])->name('login-process');
Route::get('logout-process', [AuthController::class, 'logoutProcess'])->name('logout-process');
Route::get('register', [AuthController::class, 'registerPage'])->name('register');
Route::post('register-process', [AuthController::class, 'registerProcess'])->name('register-process');



Route::middleware(['role:customer'])->group(function(){
    Route::get('buat_pesanan', [FrontendController::class, 'buat_pesanan'])->name('frontend-buat_pesanan');
    Route::post('buat_pesanan', [FrontendController::class, 'buat_pesananStore'])->name('frontend-buat_pesananStore');

    Route::get('keranjang_belanja', [FrontendController::class, 'keranjangBelanja'])->name('frontend-keranjangBelanja');
    Route::get('keranjang_belanja/hapus/{id}', [FrontendController::class, 'HapusKeranjangBelanja'])->name('frontend-HapusKeranjangBelanja');
    Route::get('keranjang_belanja/konfirmasi/{id}', [FrontendController::class, 'konfirmasiKeranjang'])->name('frontend-konfirmasiKeranjang');
    Route::post('keranjang_belanja/konfirmasi/{id}', [FrontendController::class, 'konfirmasiKeranjangStore'])->name('frontend-konfirmasiKeranjangStore');

    Route::get('daftar_pesanan', [FrontendController::class, 'daftar_pesananUser'])->name('frontend-daftar_pesananUser');
});



Route::middleware(['role:admin'])->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('dashboard/confirm/{id}', [DashboardController::class, 'indexPesananMasukA'])->name('confirm-indexPesananMasukA');
    
    Route::get('pesanan/create', [OrdersController::class, 'create'])->name('pesanan-create');
    Route::post('pesanan/create', [OrdersController::class, 'store'])->name('pesanan-store');
    
    Route::get('menunggu-jadwal', [StatusController::class, 'indexMenungguJadwal'])->name('index-indexMenungguJadwal');
    Route::get('menunggu-jadwal/confirm/{id}', [StatusController::class, 'indexMenungguJadwalA'])->name('index-indexMenungguJadwalA');
    Route::get('menunggu-jadwal/cancel/{id}', [StatusController::class, 'indexMenungguJadwalB'])->name('index-indexMenungguJadwalB');
    
    Route::get('pesanan-dibuat', [StatusController::class, 'indexPesananDibuat'])->name('index-indexPesananDibuat');
    Route::get('pesanan-dibuat/confirm/{id}', [StatusController::class, 'indexPesananDibuatA'])->name('index-indexPesananDibuatA');
    
    Route::get('pesanan-selesai', [StatusController::class, 'indexPesananSelesai'])->name('index-indexPesananSelesai');
    Route::get('pesanan-selesai/confirm/{id}', [StatusController::class, 'indexPesananSelesaiA'])->name('index-indexPesananSelesaiA');
    Route::post('pesanan-selesai/final/{id}', [StatusController::class, 'indexPesananSelesaiB'])->name('index-indexPesananSelesaiB');

    Route::get('pesanan-diantar', [StatusController::class, 'indexPesananDiantar'])->name('index-indexPesananDiantar');
    Route::post('pesanan-diantar/confirm/{id}', [StatusController::class, 'indexPesananDiantarA'])->name('index-indexPesananDiantarA');


    // sudah direvisi
    Route::controller(CustomersController::class)->group(function () {
        Route::get('pelanggan', 'index')->name('pelanggan-index');
        Route::get('pelanggan/create', 'create')->name('pelanggan-create');
        Route::post('pelanggan', 'store')->name('pelanggan-store');
        Route::get('pelanggan/edit/{customer}', 'edit')->name('pelanggan-edit');
        Route::put('pelanggan/{customer}', 'update')->name('pelanggan-update');
        Route::delete('pelanggan/{customer}', 'destroy')->name('pelanggan-destroy');
    });

    Route::controller(CategoriesController::class)->group(function () {
        Route::get('kategori', 'index')->name('kategori-index');
        Route::get('kategori/create', 'create')->name('kategori-create');
        Route::post('kategori', 'store')->name('kategori-store');
        Route::get('kategori/edit/{kategori}', 'edit')->name('kategori-edit');
        Route::put('kategori/{kategori}', 'update')->name('kategori-update');
        Route::delete('kategori/{kategori}', 'destroy')->name('kategori-destroy');
    });

    Route::controller(ProductsController::class)->group(function () {
        Route::get('produk', 'index')->name('produk-index');
        Route::get('produk/create', 'create')->name('produk-create');
        Route::post('produk', 'store')->name('produk-store');
        Route::get('produk/edit/{produk}', 'edit')->name('produk-edit');
        Route::put('produk/{produk}', 'update')->name('produk-update');
        Route::delete('produk/{produk}', 'destroy')->name('produk-destroy');
    });

    Route::controller(EmployeesController::class)->group(function () {
        Route::get('karyawan', 'index')->name('karyawan-index');
        Route::get('karyawan/create', 'create')->name('karyawan-create');
        Route::post('karyawan', 'store')->name('karyawan-store');
        Route::get('karyawan/edit/{employees}', 'edit')->name('karyawan-edit');
        Route::put('karyawan/{employees}', 'update')->name('karyawan-update');
        Route::delete('karyawan/{employees}', 'destroy')->name('karyawan-destroy');
    });

    Route::controller(SalariesController::class)->group(function () {
        Route::get('gaji', 'index')->name('gaji-index');
        Route::get('gaji/create', 'create')->name('gaji-create');
        Route::post('gaji', 'store')->name('gaji-store');
        Route::delete('gaji/{salary}', 'destroy')->name('gaji-destroy');
    });

    Route::controller(ExpenseController::class)->group(function () {
        Route::get('pengeluaran', 'index')->name('pengeluaran-index');
        Route::get('pengeluaran/create', 'create')->name('pengeluaran-create');
        Route::post('pengeluaran', 'store')->name('pengeluaran-store');
        Route::get('pengeluaran/edit/{expense}', 'edit')->name('pengeluaran-edit');
        Route::put('pengeluaran/{expense}', 'update')->name('pengeluaran-update');
        Route::delete('pengeluaran/{expense}', 'destroy')->name('pengeluaran-destroy');
    });

    Route::controller(SalesReportController::class)->group(function () {
        Route::get('laporan_penjualan', 'index')->name('laporan_penjualan-index');
    });
});
