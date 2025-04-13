<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CategoryController;

// USER ROUTES ---------------------------------------------------------------------------------------
    // General
    Route::get('/', [GeneralController::class, 'userHomepage'])->name('homepage');

    // Contact Page
    Route::get('/contact', [GeneralController::class, 'showContactPage'])->name('contact');
    Route::post('/contact', [GeneralController::class, 'sendContactForm'])->name('contact.send');

    // About Page
    Route::get('/about', function () { return view('user.about'); })->name('about');

    //Footer Policies & FAQ
    Route::get('/policies/privacy-policy', [GeneralController::class, 'showPrivacyPolicyPage'])->name('privacy-policy');
    Route::get('/policies/refund-policy', [GeneralController::class, 'showRefundPolicyPage'])->name('refund-policy');
    Route::get('/policies/shipping-policy', [GeneralController::class, 'showShippingPolicyPage'])->name('shipping-policy');
    Route::get('/policies/terms-of-service', [GeneralController::class, 'showTermsofServicePage'])->name('terms-of-service');
    Route::get('/policies/faq', [GeneralController::class, 'showFaqPage'])->name('faq');

    // SHOP
        // Shop Page
        Route::get('/shop', [ProductController::class, 'showShopPage'])->name('shop.index');
        // Cart operations
        Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
        Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');
        Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
        //Check out products in cart
        Route::get('/checkout', [CheckoutController::class, 'showCheckoutPage'])->name('checkout');
        Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
        Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');


// ADMIN ROUTES ---------------------------------------------------------------------------------------
    // Admin login
    Route::get('/admin', [AdminController::class, 'showAdminLogin']);
    Route::post('/admin', [AdminController::class, 'adminLogin']);

    // Admin Dashboard
        Route::prefix('admin')
        ->middleware(['isAdmin'])
        ->name('admin.')
        ->group(function () {
            Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('dashboard');
            Route::resource('/products', ProductController::class);
                Route::delete('/products/images/{id}', [ProductController::class, 'destroyProductImage'])->name('products.images.destroy');
            Route::resource('/categories', CategoryController::class);
            Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
            Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
            Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
            Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
            Route::post('/logout', [AdminController::class, 'adminLogout'])->name('logout');
        });
        Route::put('/admin/products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])
            ->name('admin.products.toggleFeatured');



