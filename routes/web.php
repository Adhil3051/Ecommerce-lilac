<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Cart\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Api\ProductController as ApiProductController;

use Illuminate\Support\Facades\Route;




//admin routes
Route::middleware(['role:admin'])->prefix('admin')->as('admin.')->group(function() {

    Route::get('dashboard',[HomeController::class, 'index'])->name('dashboard');
    Route::get('products',[ProductController::class,'index'])->name('products');
    Route::get('product/add',[ProductController::class,'create'])->name('add-product');
    Route::post('products/store',[ProductController::class,'store'])->name('products.store');
    Route::get('product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::post('products/update/{id}',[ProductController::class,'update'])->name('products.update');
    Route::get('products/delete/{id}',[ProductController::class,'destroy'])->name('product.delete');
    Route::get('orders',[HomeController::class, 'Orders'])->name('orders');

    


});

//public routes
Route::get('/',[CommonController::class,'index'])->name('ecommerce');
Route::get('login',[LoginController::class, 'loginForm'])->name('login');
Route::get('register',[LoginController::class, 'registerForm'])->name('register');
Route::post('user-login',[LoginController::class, 'doLogin'])->name('user-login');
Route::get('/products/filter',[CommonController::class, 'productFilter']);
Route::get('admin',[AdminLoginController::class,'loginForm'])->name('login-form');
Route::post('admin/login',[AdminLoginController::class, 'adminLoginPost'])->name('admin-login');
Route::match(['get','post'],'logout',[AdminLoginController::class, 'logout'])->name('logout');
Route::get('cart',[CommonController::class,'cartView'])->name('cart.index');
Route::get('orders',[CommonController::class,'userOrders'])->name('orders');


//api routes
Route::prefix('api')->group(function () {
    Route::get('/products', [ApiProductController::class, 'index']);
    Route::post('/user/login', [AuthController::class, 'doLogin']);
    Route::post('user/register', [AuthController::class, 'doRegister']);

    
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/cart/add', [CartController::class, 'add']);
        Route::get('/cart', [CartController::class, 'view']);
        Route::post('/cart/update', [CartController::class, 'cartUpdate']);
        Route::post('/cart/remove', [CartController::class, 'removeItem']);
        Route::post('/orders', [CartController::class, 'placeOrder']);
        Route::get('/orders/get', [CartController::class, 'getUserOrder']);


        
        
        // Route::post('/orders', [OrderController::class, 'placeOrder']);
    });
});