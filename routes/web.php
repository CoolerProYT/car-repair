<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// User controllers
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\SettingController;
use App\Http\Controllers\User\EmergencyController as UserEmergencyController;
use App\Http\Controllers\User\ChatController as UserChatController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\ProductController as UserProductController;

// Seller controllers
use App\Http\Controllers\Seller\AuthController as SellerAuthController;
use App\Http\Controllers\Seller\SellerPanelController;
use App\Http\Controllers\Seller\SettingController as SellerSettingController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\EmergencyController;
use App\Http\Controllers\Seller\ChatController as SellerChatController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\WithdrawController;

// Admin controllers
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\EmergencyController as AdminEmergencyController;
use App\Http\Controllers\Admin\SlideshowController;
use App\Http\Controllers\Admin\WithdrawController as AdminWithdrawController;

// User routes
Route::prefix('/')->group(function () {
    Route::controller(UserAuthController::class)->group(function(){
        Route::get('/login', 'login')->name('user.login');
        Route::get('/register', 'register')->name('user.register');
        Route::get('/logout', 'logout')->name('user.logout');
        Route::get('/reset_password', 'resetPassword')->name('user.reset_password');
    });

    Route::controller(HomeController::class)->group(function(){
        Route::get('/', 'home')->name('user.home');
        Route::get('/contact', 'contact')->name('user.contact');
    });

    Route::controller(UserEmergencyController::class)->group(function(){
        Route::get('/emergency/{category}', 'emergency')->name('user.emergency');
        Route::get('/emergency/detail/{id}', 'emergencyDetail')->name('user.emergency.detail');
    });

    Route::controller(UserProductController::class)->group(function(){
        Route::get('/product/{category}', 'product')->name('user.product');
        Route::get('/product/detail/{id}', 'productDetail')->name('user.product.detail');
    });

    Route::middleware('auth:user')->group(function () {
        Route::controller(UserChatController::class)->group(function(){
            Route::get('/chat/{seller_id}', 'chat')->name('user.chat');
        });

        Route::controller(SettingController::class)->prefix('settings')->group(function(){
            Route::get('/', 'settings')->name('user.settings');
        });

        Route::controller(UserEmergencyController::class)->group(function(){
            Route::get('/emergency/checkout/{id}', 'emergencyCheckout')->name('user.emergency.checkout');
            Route::get('/emergency/payment/card', 'emergencyPay')->name('user.emergency.pay');
            Route::get('/emergency/payment/handle','emergencyHandle')->name('user.emergency.handle');
        });

        Route::controller(UserProductController::class)->group(function(){
            Route::get('/product/checkout/{id}', 'productCheckout')->name('user.product.checkout');
            Route::get('/product/payment/card', 'productPay')->name('user.product.pay');
            Route::get('/product/payment/handle','productHandle')->name('user.product.handle');
        });

        Route::controller(UserOrderController::class)->group(function(){
            Route::get('/order', 'order')->name('user.order');
        });
    });
});

// Seller routes
Route::prefix('seller')->group(function () {
    Route::controller(SellerAuthController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/login', 'login')->name('seller.login');
        Route::get('/register', 'register')->name('seller.register');
        Route::get('/reset_password', '')->name('seller.reset_password');
        Route::get('/logout', 'logout')->name('seller.logout');
        Route::get('/reset_password', 'resetPassword')->name('seller.reset_password');
    });

    Route::middleware('auth:seller')->group(function () {
        Route::controller(SellerPanelController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('seller.dashboard');
        });

        Route::controller(SellerSettingController::class)->prefix('settings')->group(function(){
            Route::get('/', 'settings')->name('seller.settings');
            Route::get('/account', 'account')->name('seller.settings.account');
            Route::get('/shop', 'shop')->name('seller.settings.shop');
        });

        Route::controller(ProductController::class)->prefix('product')->group(function(){
            Route::get('/', 'product')->name('seller.product');
            Route::get('/add','addProduct')->name('seller.product.add');
            Route::get('/edit/{id}','editProduct')->name('seller.product.edit');
        });

        Route::controller(EmergencyController::class)->prefix('emergency')->group(function(){
            Route::get('/', 'emergency')->name('seller.emergency');
            Route::get('/add','addEmergency')->name('seller.emergency.add');
            Route::get('/edit/{id}','editEmergency')->name('seller.emergency.edit');
        });

        Route::controller(SellerChatController::class)->group(function(){
            Route::get('/chat/{user_id}', 'chat')->name('seller.chat');
        });

        Route::controller(SellerOrderController::class)->group(function(){
            Route::get('/order', 'order')->name('seller.order');
        });

        Route::controller(WithdrawController::class)->group(function(){
            Route::get('/withdraw', 'withdraw')->name('seller.withdraw');
        });
    });
});

// Admin routes
Route::prefix('admin')->group(function () {
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/login', 'login')->name('admin.login');
        Route::get('/logout', 'logout')->name('admin.logout');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
        });

        Route::controller(AdminProductController::class)->group(function(){
            Route::get('/product', 'product')->name('admin.product');
        });

        Route::controller(AdminEmergencyController::class)->group(function(){
            Route::get('/emergency', 'emergency')->name('admin.emergency');
        });

        Route::controller(SlideshowController::class)->group(function(){
            Route::get('/slideshow', 'slideshow')->name('admin.slideshow');
        });

        Route::controller(AdminWithdrawController::class)->group(function(){
            Route::get('/withdraw', 'withdraw')->name('admin.withdraw');
        });
    });
});

// This route will be used to redirect the user to the login page if they try to access a page they are not authorized to access.
Route::get('/403', function (Request $request) {
    if($request->getHost() === env('BASE_DOMAIN')) {
        return redirect()->route('user.login');
    }
    else if($request->getHost() === env('SELLER_DOMAIN')) {
        return redirect()->route('seller.login');
    }
    else if($request->getHost() === env('ADMIN_DOMAIN')) {
        return redirect()->route('admin.login');
    }
})->name('login');
