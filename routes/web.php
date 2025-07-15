<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Import Controllers with Aliases to prevent name conflicts
// =================================================================

// --- Public/Frontend Controllers ---
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as FrontendProductController;
use App\Http\Controllers\CategoryController as FrontendCategoryController;
use App\Http\Controllers\ServiceController as FrontendServiceController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\FeedbackController as FrontendFeedbackController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SettingsController;


// --- Authentication Controllers ---
// Catatan: AdminLoginController sekarang akan menggunakan guard standar
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\UserRegisterController;


/*
|--------------------------------------------------------------------------
| WEB ROUTES (Versi Lengkap)
|--------------------------------------------------------------------------
|
| File ini mengatur semua routing untuk aplikasi web, termasuk:
| 1. Rute Publik (dapat diakses semua orang)
| 2. Rute Otentikasi & Dasbor Pengguna
| 3. Rute Otentikasi & Panel Admin
|
*/

// =====================================================
// PUBLIC ROUTES
// =====================================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Produk, Kategori, Jasa (Frontend)
Route::get('/produk', [FrontendProductController::class, 'showProducts'])->name('produk.index');
Route::get('/produk/{id}', [FrontendProductController::class, 'show'])->name('produk.show');
Route::get('/kategori', [FrontendCategoryController::class, 'index'])->name('kategori.index');
Route::get('/kategori/{slug}', [FrontendCategoryController::class, 'show'])->name('kategori.show');
Route::get('/jasa', [FrontendServiceController::class, 'index'])->name('jasa.index');
Route::get('/jasa/{id}', [FrontendServiceController::class, 'show'])->name('jasa.detail');

// Halaman Tentang Kami, Kontak, dll.
Route::view('/tentang-kami', 'hsnstudio.tentangkami.tentang')->name('tentang.kami');
Route::get('/portofolio', [TentangKamiController::class, 'portofolio'])->name('portofolio');
Route::get('/logo-brand', [TentangKamiController::class, 'logoBrand'])->name('tentangkami.logobrand');
Route::get('/galeri-kami', [GalleryController::class, 'index'])->name('galeri.kami');
Route::view('/media-sosial', 'hsnstudio.kontak.mediasosial.medsos')->name('media.sosial');

// Halaman Kritik & Saran (Frontend)
Route::resource('kritiksaran', FrontendFeedbackController::class)->except(['edit', 'update']);

// Halaman Keranjang Belanja (Cart)
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{id}', [CartController::class, 'add'])->name('add');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('clear');
    // Middleware 'auth' sudah benar (sama dengan 'auth:web')
    Route::post('/checkout', [CartController::class, 'checkout'])->middleware('auth')->name('checkout');
});


// =====================================================
// USER AUTH & DASHBOARD ROUTES
// =====================================================

// Rute untuk Login, Register & Logout Pengguna Biasa
Route::get('/hsnstudio/login', [UserLoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/hsnstudio/login', [UserLoginController::class, 'login'])->name('user.login.post');
Route::get('/hsnstudio/register', [UserRegisterController::class, 'showRegistrationForm'])->name('user.register');
Route::post('/hsnstudio/register', [UserRegisterController::class, 'register'])->name('user.register.post');
Route::post('/hsnstudio/logout', [UserLoginController::class, 'logout'])->middleware('auth')->name('user.logout');

// Rute yang memerlukan login sebagai pengguna biasa (guard: web)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/account', [AccountController::class, 'index'])->name('account');

    // Pengaturan Akun Pengguna
    Route::prefix('settings')->name('settings.')->group(function() {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::redirect('/', '/settings/profile');
        Volt::route('profile', 'settings.profile')->name('profile');
        Volt::route('password', 'settings.password')->name('password');
        Volt::route('appearance', 'settings.appearance')->name('appearance');
    });
});


// =====================================================
// ADMIN AUTH & PANEL ROUTES (SUDAH DIPERBAIKI)
// =====================================================

// Rute untuk Login & Logout Admin
Route::prefix('admin')->name('admin.')->group(function() {
    // Menggunakan 'guest' standar, untuk tamu yang belum login
    Route::middleware('guest')->group(function () {
        Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminLoginController::class, 'login'])->name('login.post');
    });
    // Menggunakan 'auth' standar, karena pengecekan peran sudah dilakukan di controller/middleware
    Route::post('logout', [AdminLoginController::class, 'logout'])->middleware('auth')->name('logout');
});

// Semua rute di dalam grup ini akan memiliki awalan /admin
// dan memerlukan login sebagai admin (dicek oleh middleware 'is.admin')
Route::middleware(['auth', 'is.admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Volt::route('/', 'admin.dashboard')->name('dashboard');

    // Kategori -> merujuk ke folder 'livewire/admin/categories'
    Volt::route('categories', 'admin.categories.admin_category')->name('categories.index');
    Volt::route('categories/create', 'admin.categories.add_category')->name('categories.create');
    Volt::route('categories/{category}/edit', 'admin.categories.edit_category')->name('categories.edit');

    // Produk -> merujuk ke folder 'livewire/admin/product'
    Volt::route('products', 'admin.product.admin_product')->name('products.index');
    Volt::route('products/create', 'admin.product.add_product')->name('products.create');
    Volt::route('products/{product}/edit', 'admin.product.edit_product')->name('products.edit');

    // Jasa (Services) -> merujuk ke folder 'livewire/admin/servicess'
    Volt::route('services', 'admin.servicess.admin_services')->name('services.index');
    Volt::route('services/create', 'admin.servicess.add_services')->name('services.create');
    Volt::route('services/{service}/edit', 'admin.servicess.edit_services')->name('services.edit');

    // Kritik & Saran (Feedback) -> merujuk ke folder 'livewire/admin/feedbacks'
    Volt::route('feedback', 'admin.feedbacks.admin_feedback')->name('feedback.index');

    // Transaksi -> merujuk ke folder 'livewire/admin/transaction'
    Volt::route('transactions', 'admin.transaction.admin_transaction')->name('transactions.index');
    Volt::route('transactions/{transaction}', 'admin.transaction.show_transaction')->name('transactions.show');
});


// =====================================================
// BREEZE/FORTIFY AUTH SUPPORT (JIKA ADA)
// =====================================================
// File ini biasanya untuk rute seperti verifikasi email, lupa password, dll.
// untuk sistem otentikasi pengguna biasa.
require __DIR__ . '/auth.php';
