<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

// routes/web.php
//Route::get('/', [UserController::class, 'landing'])->name('home');
Route::get('/', function () {
    return view('user.mainlanding');
})->name('home');

// Admin Login Routes (protected by isLoggedIn Middleware)
Route::middleware('admin.isLoggedIn')->group(function () {
    Route::get('/admin-login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin-login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

// ------------------ Admin Dashboard Routes ------------------
Route::middleware('admin.authCheck')->group(function () {
    Route::get('/admin-dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin-users', [AdminAuthController::class, 'users'])->name('admin.users');
    Route::get('/admin-listing', [AdminAuthController::class, 'listing'])->name('admin.listing');
    Route::get('/admin-vendors', [AdminAuthController::class, 'vendors'])->name('admin.vendors');
//    Route::get('/admin-reports', [AdminAuthController::class, 'reports'])->name('admin.reports');
    Route::get('/admin-payments', [AdminAuthController::class, 'payments'])->name('admin.payments');
    Route::get('/admin-logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Property Actions
    Route::post('/admin/property/{id}/approve', [AdminAuthController::class, 'approveProperty'])->name('admin.property.approve');
    Route::post('/admin/property/{id}/reject', [AdminAuthController::class, 'rejectProperty'])->name('admin.property.reject');
    Route::get('/admin/property/{id}/view', [AdminAuthController::class, 'viewProperty'])->name('admin.property.view');

    // Car Actions
    Route::post('/admin/car/{id}/approve', [AdminAuthController::class, 'approveCar'])->name('admin.car.approve');
    Route::post('/admin/car/{id}/reject', [AdminAuthController::class, 'rejectCar'])->name('admin.car.reject');
    Route::get('/admin/car/{id}/view', [AdminAuthController::class, 'viewCar'])->name('admin.car.view');

    // Room Actions
    Route::post('/admin/room/{id}/approve', [AdminAuthController::class, 'approveRoom'])->name('admin.room.approve');
    Route::post('/admin/room/{id}/reject', [AdminAuthController::class, 'rejectRoom'])->name('admin.room.reject');
    Route::get('/admin/room/{id}/view', [AdminAuthController::class, 'viewRoom'])->name('admin.room.view');

    // Vendor Actions
    Route::post('/admin/vendor/{vendor}/approve', [AdminAuthController::class, 'approveVendor'])->name('admin.vendor.approve');
    Route::post('/admin/vendor/{vendor}/delete', [AdminAuthController::class, 'deleteVendor'])->name('admin.vendor.delete');
    Route::get('/admin/vendor/{vendor}/listings', [AdminAuthController::class, 'vendorListings'])->name('admin.vendor.listings');
});

// ------------------ Vendor Routes ------------------
Route::middleware('vendor.isLoggedIn')->group(function () {
    Route::get('/vendor-register', [VendorController::class, 'showRegisterForm'])->name('vendor.showRegister');
    Route::post('/vendor-register', [VendorController::class, 'store'])->name('vendor.register');

    Route::get('/vendor-login', [VendorController::class, 'showLoginForm'])->name('vendor.showLogin');
    Route::post('/vendor-login', [VendorController::class, 'login'])->name('vendor.login');
});

// ------------------ Vendor Protected Content ------------------
Route::middleware('vendor.authCheck')->group(function () {
    Route::get('/vendor-main', [VendorController::class, 'showMain'])->name('vendor.main');

    Route::get('/vendor/add-property', [VendorController::class, 'showAddProperty'])->name('vendor.addProperty');
    Route::post('/vendor/add-property', [VendorController::class, 'storeProperty'])->name('vendor.storeProperty');

    Route::get('/vendor/facilities', [VendorController::class, 'showFacilities'])->name('vendor.facilities');
    Route::get('/vendor/services', [VendorController::class, 'showServices'])->name('vendor.services');
    Route::get('/vendor/cars', [VendorController::class, 'showCars'])->name('vendor.cars');
    Route::post('/vendor/store-car', [VendorController::class, 'storeCar'])->name('vendor.storeCar');

    Route::get('/vendor/rooms', [VendorController::class, 'showRooms'])->name('vendor.rooms');
    Route::post('/vendor/store-room', [VendorController::class, 'storeRoom'])->name('vendor.storeRoom');

    // Overview & Detail
    Route::get('/vendor/overview', [VendorController::class, 'showOverview'])->name('vendor.showOverview');

    Route::get('/vendor/item/{type}/{id}', [VendorController::class, 'itemDetail'])->name('vendor.itemDetail');

    Route::post('/vendor-logout', [VendorController::class, 'logout'])->name('vendor.logout');
});

// ------------------ Profile Routes (Default Laravel Auth) ------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('user.authCheck')->group(function () {
    Route::get('/destination/{location}', [UserController::class, 'showRoomsByLocation'])->name('user.rooms.byLocation');

    Route::get('/checkout/{id}', [UserController::class, 'showCheckoutForm'])
        ->name('user.checkout');
    Route::post('/checkout/{id}', [UserController::class, 'room_checkout'])
        ->name('user.checkout.submit');

    /* Cars */
    Route::get('/user/carexplore',  [UserController::class,'showCars'])
        ->name('user.carexplore');

    Route::get('/user/cars/{id}',   [UserController::class,'showCar'])
        ->name('user.car.show');



    Route::get('/checkout/{type}/{id}', [UserController::class,'showCheckoutForm'])
        ->name('user.checkout');               // e.g. /checkout/room/7  or /checkout/car/12
    Route::post('/checkout/{type}/{id}', [UserController::class,'submitCheckout'])
        ->name('user.checkout.submit');


    Route::get('/thankyou', function () {
        return view('user.thankyou');
    })->name('user.thankyou');
});

// ------------------ User Routes ------------------

// main landing page route

Route::get('/user/destinationexplore', [UserController::class, 'showDestination'])->name('user.destinationexplore');
Route::get('/user/hotelexplore', [UserController::class, 'showHotels'])->name('user.hotelexplore');

Route::middleware('user.isLoggedIn')->group(function () {
    Route::get('/user-auth', [UserController::class, 'showAuthform'])->name('user.auth');
    Route::post('/user-login', [UserController::class, 'login'])->name('user.login.submit');
    Route::post('/user-register', [UserController::class, 'store'])->name('user.store.submit');
});

// MJ - added on 2025-04-23 19:00 (Asia/Dhaka)




require __DIR__ . '/auth.php';
