<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// --- Public / Frontend Controllers ---
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
use App\Http\Controllers\CheckoutController;

// --- Authentication Controllers ---
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\UserRegisterController;

// --- Admin Controllers ---
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ServicesController as AdminServicesController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES (Complete Version)
|--------------------------------------------------------------------------
|
| File ini mengatur semua routing untuk aplikasi web, termasuk:
| - Rute Publik (bisa diakses semua orang)
| - Rute Otentikasi & Dasbor Pengguna
| - Rute Admin & Panel Admin
|
*/

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Produk, Kategori, dan Jasa (Frontend)
Route::get('/produk', [FrontendProductController::class, 'showProducts'])->name('produk.index');
Route::get('/produk/{id}', [FrontendProductController::class, 'show'])->name('produk.show');

Route::get('/kategori', [FrontendCategoryController::class, 'index'])->name('kategori.index');
Route::get('/kategori/{slug}', [FrontendCategoryController::class, 'show'])->name('kategori.show');

Route::get('/jasa', [FrontendServiceController::class, 'index'])->name('jasa.index');
Route::get('/jasa/{id}', [FrontendServiceController::class, 'show'])->name('jasa.detail');

// Halaman Tentang Kami, Portofolio, Galeri, dan Media Sosial
Route::view('/tentang-kami', 'hsnstudio.tentangkami.tentang')->name('tentang.kami');
Route::get('/portofolio', [TentangKamiController::class, 'portofolio'])->name('portofolio');
Route::get('/logo-brand', [TentangKamiController::class, 'logoBrand'])->name('tentangkami.logobrand');
Route::get('/galeri-kami', [GalleryController::class, 'index'])->name('galeri.kami');
Route::view('/media-sosial', 'hsnstudio.kontak.mediasosial.medsos')->name('media.sosial');

// Halaman Kritik & Saran (Frontend)
Route::resource('kritiksaran', FrontendFeedbackController::class)->except(['edit', 'update']);

// Keranjang Belanja (Cart) dengan prefix dan nama route 'cart.'
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{id}', [CartController::class, 'add'])->name('add');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('clear');
    Route::post('/checkout', [CartController::class, 'checkout'])->middleware('auth')->name('checkout');
});

/*
|--------------------------------------------------------------------------
| USER AUTHENTICATION & PROTECTED ROUTES (GUARD: web)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard dan Akun
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/account', [AccountController::class, 'index'])->name('account');

    // Pengaturan Akun dengan prefix settings dan Livewire Volt routes
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::redirect('/', '/settings/profile');
        Volt::route('profile', 'settings.profile')->name('profile');
        Volt::route('password', 'settings.password')->name('password');
        Volt::route('appearance', 'settings.appearance')->name('appearance');
    });

    // Halaman Keranjang dan Checkout
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
});

/*
|--------------------------------------------------------------------------
| USER AUTH & PUBLIC ROUTES (Login, Register, Logout)
|--------------------------------------------------------------------------
*/

// Login dan Register Pengguna Biasa
Route::get('/hsnstudio/login', [UserLoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/hsnstudio/login', [UserLoginController::class, 'login'])->name('user.login.post');
Route::get('/hsnstudio/register', [UserRegisterController::class, 'showRegistrationForm'])->name('user.register');
Route::post('/hsnstudio/register', [UserRegisterController::class, 'register'])->name('user.register.post');

// Logout (hanya untuk user yang sudah login)
Route::post('/hsnstudio/logout', [UserLoginController::class, 'logout'])->middleware('auth')->name('user.logout');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH & PANEL ROUTES
|--------------------------------------------------------------------------
*/

// Admin Login & Logout (guest dan auth middleware)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminLoginController::class, 'login'])->name('login.post');
    });

    Route::post('logout', [AdminLoginController::class, 'logout'])->middleware('auth')->name('logout');
});

// Admin Panel Routes (memerlukan auth dan middleware is.admin)
Route::middleware(['auth', 'is.admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Kategori
    Route::resource('categories', AdminCategoryController::class);

    // Manajemen Produk
    Route::resource('products', AdminProductController::class);

    // Manajemen Jasa / Services
    Route::resource('services', AdminServicesController::class);

    // Kritik & Saran (Feedback)
    Route::resource('feedback', AdminFeedbackController::class)->only(['index', 'show', 'destroy']);

    // Manajemen Transaksi
    Route::get('transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/{transaction}', [AdminTransactionController::class, 'show'])->name('transactions.show');
    Route::post('transactions/{transaction}/update-status', [AdminTransactionController::class, 'updateStatus'])->name('transactions.updateStatus');
    Route::patch('/transaction-items/{item}/action', [AdminTransactionController::class, 'updateAction'])->name('admin.transaction-items.updateAction');
});

/*
|--------------------------------------------------------------------------
| AUTH SUPPORT (Breeze/Fortify atau lainnya)
|--------------------------------------------------------------------------
|
| File ini biasanya berisi rute terkait otentikasi seperti reset password,
| verifikasi email, dsb.
|
*/
require __DIR__ . '/auth.php';
