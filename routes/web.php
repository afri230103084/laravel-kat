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



Route::middleware(['auth:customer'])->group(function(){
    Route::get('myProfile', [FrontendController::class, 'myProfile'])->name('frontend-myProfile');
    Route::get('buat_pesanan', [FrontendController::class, 'buat_pesanan'])->name('frontend-buat_pesanan');
    Route::post('buat_pesanan', [FrontendController::class, 'buat_pesananStore'])->name('frontend-buat_pesananStore');
    Route::get('daftar_pesanan', [FrontendController::class, 'daftar_pesananUser'])->name('frontend-daftar_pesananUser');
    Route::post('/midtrans/webhook', [FrontendController::class, 'handleWebhook'])->name('midtrans.webhook');
});

Route::middleware(['auth:user'])->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/confirm/{id}', [DashboardController::class, 'indexPesananMasukA'])->name('index-indexPesananMasukA');
    
    Route::get('kategori', [CategoriesController::class, 'index'])->name('kategori-index');
    Route::get('kategori/create', [CategoriesController::class, 'create'])->name('kategori-create');
    Route::post('kategori/create', [CategoriesController::class, 'store'])->name('kategori-store');
    Route::get('kategori/edit/{id}', [CategoriesController::class, 'edit'])->name('kategori-edit');
    Route::post('kategori/update/{id}', [CategoriesController::class, 'update'])->name('kategori-update');
    Route::get('kategori/hapus/{id}', [CategoriesController::class, 'destroy'])->name('kategori-destroy');
    
    Route::get('produk', [ProductsController::class, 'index'])->name('produk-index');
    Route::get('produk/create', [ProductsController::class, 'create'])->name('produk-create');
    Route::post('produk/create', [ProductsController::class, 'store'])->name('produk-store');
    Route::get('produk/edit/{id}', [ProductsController::class, 'edit'])->name('produk-edit');
    Route::post('produk/update/{id}', [ProductsController::class, 'update'])->name('produk-update');
    Route::get('produk/hapus/{id}', [ProductsController::class, 'destroy'])->name('produk-destroy');
    
    Route::get('pelanggan', [CustomersController::class, 'index'])->name('pelanggan-index');
    Route::get('pelanggan/create', [CustomersController::class, 'create'])->name('pelanggan-create');
    Route::post('pelanggan/create', [CustomersController::class, 'store'])->name('pelanggan-store');
    Route::get('pelanggan/edit/{id}', [CustomersController::class, 'edit'])->name('pelanggan-edit');
    Route::post('pelanggan/update/{id}', [CustomersController::class, 'update'])->name('pelanggan-update');
    Route::get('pelanggan/hapus/{id}', [CustomersController::class, 'destroy'])->name('pelanggan-destroy');
    
    Route::get('karyawan', [EmployeesController::class, 'index'])->name('karyawan-index');
    Route::get('karyawan/create', [EmployeesController::class, 'create'])->name('karyawan-create');
    Route::post('karyawan/create', [EmployeesController::class, 'store'])->name('karyawan-store');
    Route::get('karyawan/edit/{id}', [EmployeesController::class, 'edit'])->name('karyawan-edit');
    Route::post('karyawan/update/{id}', [EmployeesController::class, 'update'])->name('karyawan-update');
    Route::get('karyawan/hapus/{id}', [EmployeesController::class, 'destroy'])->name('karyawan-destroy');
    
    Route::get('gaji', [SalariesController::class, 'index'])->name('gaji-index');
    Route::get('gaji/create', [SalariesController::class, 'create'])->name('gaji-create');
    Route::post('gaji/create', [SalariesController::class, 'store'])->name('gaji-store');
    Route::get('gaji/hapus/{id}', [SalariesController::class, 'destroy'])->name('gaji-destroy');

    Route::get('pengeluaran', [ExpenseController::class, 'index'])->name('pengeluaran-index');
    Route::get('pengeluaran/create', [ExpenseController::class, 'create'])->name('pengeluaran-create');
    Route::post('pengeluaran/create', [ExpenseController::class, 'store'])->name('pengeluaran-store');
    Route::get('pengeluaran/edit/{id}', [ExpenseController::class, 'edit'])->name('pengeluaran-edit');
    Route::post('pengeluaran/update/{id}', [ExpenseController::class, 'update'])->name('pengeluaran-update');
    Route::get('pengeluaran/hapus/{id}', [ExpenseController::class, 'destroy'])->name('pengeluaran-destroy');
    
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

    Route::get('laporan_penjualan', [SalesReportController::class, 'index'])->name('laporan_penjualan-index');
});
