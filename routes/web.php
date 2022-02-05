<?php

use App\Http\Controllers\Admin\TransactionController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/* Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});
 */

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])
        ->name('home');
Route::get('/catalog', [\App\Http\Controllers\CatalogController::class, 'catalog'])
        ->name('catalog');
Route::get('/catalog/{id}', [\App\Http\Controllers\CatalogController::class, 'detail'])
        ->name('catalog-details');

Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'contact'])
        ->name('contact');

Route::get('/details/{id}', [\App\Http\Controllers\DetailController::class, 'detail'])
        ->name('detail');
Route::POST('/details/{id}', [\App\Http\Controllers\DetailController::class, 'add'])
        ->name('detail-add');


// Authentification
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])
        ->name('login');

Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])
        ->name('register');
Route::get('/register/success', [\App\Http\Controllers\Auth\RegisterController::class, 'registration_success'])
        ->name('registration-success');

// User Authenticated
Route::group(['middleware' => ['auth']], function() {
        Route::get('/cart', [\App\Http\Controllers\CartController::class, 'cart'])
                ->name('cart');
        Route::delete('/cart/{id}', [\App\Http\Controllers\CartController::class, 'delete'])
                ->name('cart-delete');

        Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'process'])
                ->name('checkout');
        Route::post('/checkout/callback', [\App\Http\Controllers\CheckoutController::class, 'callback'])
                ->name('midtrans-callback');

        // Dashboard
        Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
                ->name('dashboard');

        Route::get('/dashboard/product', [\App\Http\Controllers\DashboardProductController::class, 'dashboard_product'])
                ->name('dashboard-product');
        Route::get('/dashboard/product/details/{id}', [\App\Http\Controllers\DashboardProductController::class, 'detail'])
                ->name('dashboard-product-detail');
        Route::get('/dashboard/product/add', [\App\Http\Controllers\DashboardProductController::class, 'create'])
                ->name('dashboard-product-create');

        Route::get('/dashboard/transactions', [\App\Http\Controllers\DashboardTransactionController::class, 'dashboard_transaction'])
                ->name('dashboard-transaction');
        Route::get('/dashboard/transactions/{id}', [\App\Http\Controllers\DashboardTransactionController::class, 'detail'])
                ->name('dashboard-transaction-detail');
        Route::post('/dashboard/transactions/{id}', [\App\Http\Controllers\DashboardTransactionController::class, 'update'])
                ->name('dashboard-transaction-update');

        Route::get('/dashboard/account', [\App\Http\Controllers\DashboardSettingController::class, 'account'])
                ->name('dashboard-account');
        Route::POST('/dashboard/update/{redirect}', [\App\Http\Controllers\DashboardSettingController::class, 'update'])
                ->name('dashboard-setting-redirect');
});


// Admin Authenticated
Route::prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->middleware(['auth', 'admin'])
    ->group(function() {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
                ->name('admin-dashboard');
        Route::resource('category', 'CategoryController');
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('product-gallery', 'ProductGalleryController');
        Route::resource('transaction', 'TransactionController');
    });

Auth::routes();

