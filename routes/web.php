<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Public Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as FrontendProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CartController;

// Auth Controllers
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\UserRegisterController;

// User Controllers
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\SettingsController;

// Admin Controllers
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ServicesController as AdminServiceController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\TransactionController;

// =====================================================
// PUBLIC ROUTES
// =====================================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Produk
Route::get('/produk', [FrontendProductController::class, 'showProducts'])->name('produk.index');
Route::get('/produk/{id}', [FrontendProductController::class, 'show'])->name('produk.show');

// Kategori
Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori.index');
Route::get('/kategori/{slug}', [CategoryController::class, 'show'])->name('kategori.show');

// Jasa
Route::get('/jasa', [ServiceController::class, 'index'])->name('jasa.index');
Route::get('/jasa/{id}', [ServiceController::class, 'show'])->name('jasa.detail');

// Tentang Kami
Route::view('/tentang-kami', 'hsnstudio.tentangkami.tentang')->name('tentang.kami');
Route::get('/portofolio', [TentangKamiController::class, 'portofolio'])->name('portofolio');
Route::get('/logo-brand', [TentangKamiController::class, 'logoBrand'])->name('tentangkami.logobrand');

// Galeri
Route::get('/galeri-kami', [GalleryController::class, 'index'])->name('galeri.kami');

// Media Sosial
Route::view('/media-sosial', 'hsnstudio.kontak.mediasosial.medsos')->name('media.sosial');

// Feedback
Route::prefix('kritiksaran')->group(function () {
    Route::get('/', [FeedbackController::class, 'index'])->name('kritiksaran.index');
    Route::get('/create', [FeedbackController::class, 'create'])->name('kritiksaran.create');
    Route::post('/', [FeedbackController::class, 'store'])->name('kritiksaran.store');
    Route::get('/{id}', [FeedbackController::class, 'show'])->name('kritiksaran.show');
    Route::delete('/{id}', [FeedbackController::class, 'destroy'])->name('kritiksaran.destroy');
});

// Cart
Route::prefix('cart')->group(function () {
    Route::post('/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/checkout', [CartController::class, 'checkout'])->middleware('auth:web')->name('cart.checkout');
});


// =====================================================
// USER AUTH & DASHBOARD (GUARD: web)
// =====================================================
Route::middleware('guest')->group(function () {
    Route::get('hsnstudio/login', [UserLoginController::class, 'showLoginForm'])->name('user.login');
    Route::post('hsnstudio/login', [UserLoginController::class, 'login'])->name('user.login.post');

    Route::get('hsnstudio/register', [UserRegisterController::class, 'showRegisterForm'])->name('user.register');
    Route::post('hsnstudio/register', [UserRegisterController::class, 'register'])->name('user.register.post');
});

Route::post('hsnstudio/logout', [UserLoginController::class, 'logout'])->middleware('auth:web')->name('user.logout');

Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});


// =====================================================
// ADMIN AUTH & PANEL (GUARD: admin)
// =====================================================
Route::prefix('admin')->group(function () {
    // Admin Login (guest:admin)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.post');
    });

    // Admin Logout
    Route::post('/logout', [AdminLoginController::class, 'logout'])->middleware('auth:admin')->name('admin.logout');

    // Admin Panel
    Route::middleware('auth:admin')->name('admin.')->group(function () {
        Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');

        // Produk
        Route::resource('products', AdminProductController::class);

        // Kategori
        Route::resource('categories', AdminCategoryController::class);

        // Jasa
        Route::resource('services', AdminServiceController::class);

        // Feedback
        Route::get('/feedback', [AdminFeedbackController::class, 'index'])->name('feedback.index');
        Route::get('/feedback/{id}', [AdminFeedbackController::class, 'show'])->name('feedback.show');
        Route::delete('/feedback/{id}', [AdminFeedbackController::class, 'destroy'])->name('feedback.destroy');

        // Transaksi
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');
    });
});

// =====================================================
// AUTH ROUTES (Fortify/Breeze/etc.)
// =====================================================
require __DIR__.'/auth.php';
