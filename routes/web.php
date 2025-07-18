<?php

use Illuminate\Support\Facades\Route;

// --- Controllers (Frontend) ---
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
use App\Http\Controllers\CustomerTransactionController;
use App\Http\Controllers\Auth\UserLoginController;

// --- Controllers (Admin) ---
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ServicesController as AdminServicesController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\TransactionItemController as AdminTransactionItemController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

// ===================================================================================
// FRONTEND ROUTES (Public + Authenticated Customer)
// ===================================================================================

// --- Public Routes ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [FrontendProductController::class, 'showProducts'])->name('produk.index');
Route::get('/produk/{id}', [FrontendProductController::class, 'show'])->name('produk.show');
Route::get('/kategori', [FrontendCategoryController::class, 'index'])->name('kategori.index');
Route::get('/kategori/{slug}', [FrontendCategoryController::class, 'show'])->name('kategori.show');
Route::get('/jasa', [FrontendServiceController::class, 'index'])->name('jasa.index');
Route::get('/jasa/{id}', [FrontendServiceController::class, 'show'])->name('jasa.detail');
Route::view('/tentang-kami', 'hsnstudio.tentangkami.tentang')->name('tentang.kami');
Route::get('/portofolio', [TentangKamiController::class, 'portofolio'])->name('portofolio');
Route::get('/logo-brand', [TentangKamiController::class, 'logoBrand'])->name('tentangkami.logobrand');
Route::get('/galeri-kami', [GalleryController::class, 'index'])->name('galeri.kami');
Route::view('/media-sosial', 'hsnstudio.kontak.mediasosial.medsos')->name('media.sosial');
Route::resource('kritiksaran', FrontendFeedbackController::class)->except(['edit', 'update']);

// --- Customer Protected Routes ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{id}', [CartController::class, 'add'])->name('add');
        Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
        Route::post('/clear', [CartController::class, 'clear'])->name('clear');
        Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::patch('/update/{id}', [CartController::class, 'update'])->name('update');
    });

    Route::get('/transaksi-saya', [CustomerTransactionController::class, 'index'])->name('transaksi.saya');
    Route::get('/transaksi-saya/{id}', [CustomerTransactionController::class, 'show'])->name('transaksi.saya.show');
});

// --- Settings Routes (User Profile & Password) ---
Route::middleware('auth')->prefix('settings')->name('settings.')->group(function () {
    Route::get('/', [SettingsController::class, 'index'])->name('index');
    Route::patch('/profile', [SettingsController::class, 'updateProfile'])->name('profile.update');
    Route::patch('/password', [SettingsController::class, 'updatePassword'])->name('password.update');
    Route::view('/profile', 'settings.profile')->name('profile'); // Optional: view profile settings
});

// ===================================================================================
// ADMIN ROUTES
// ===================================================================================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'is.admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::resource('products', AdminProductController::class)->except(['show']);
    Route::patch('products/{product}/toggle', [AdminProductController::class, 'toggle'])->name('products.toggle');
    Route::post('products/{id}/sync', [AdminProductController::class, 'sync'])->name('products.sync');

    // Categories
    Route::resource('categories', AdminCategoryController::class);
    Route::post('categories/{id}/sync', [AdminCategoryController::class, 'sync'])->name('categories.sync');

    // Services
    Route::resource('services', AdminServicesController::class);

    // Feedback
    Route::get('/feedback', [AdminFeedbackController::class, 'index'])->name('feedback.index');
    Route::get('/feedback/{id}', [AdminFeedbackController::class, 'show'])->name('feedback.show');
    Route::delete('/feedback/{id}', [AdminFeedbackController::class, 'destroy'])->name('feedback.destroy');

    // Transactions
    Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{id}', [AdminTransactionController::class, 'show'])->name('transactions.show');

    // Transaction Items
    Route::get('/transactions/{transaction}/items', [AdminTransactionItemController::class, 'index'])->name('transactions.items.index');
    Route::get('/transactions/{transaction}/items/{item}', [AdminTransactionItemController::class, 'show'])->name('transactions.items.show');
});

// ===================================================================================
// USER AUTH (Login/Logout)
// ===================================================================================
Route::get('/hsnstudio/login', [UserLoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/hsnstudio/login', [UserLoginController::class, 'login']);
Route::post('/hsnstudio/logout', [UserLoginController::class, 'logout'])->name('user.logout');

// ===================================================================================
// DEFAULT AUTH ROUTES (Breeze/Fortify/Volt)
// ===================================================================================
require __DIR__ . '/auth.php';
