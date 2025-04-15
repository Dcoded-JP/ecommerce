<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\IProductController;
use App\Http\Controllers\ProductImageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/signup', [SiteController::class, 'signup'])->name('signup');
Route::post('/signup', [SiteController::class, 'saveSignup'])->name('saveSignup');
Route::get('/login', [SiteController::class, 'login'])->name('login');
Route::post('/login', [SiteController::class, 'processLogin'])->name('processLogin');
Route::get('/shop', [SiteController::class, 'shop'])->name('shop');
Route::get('/collection', [SiteController::class, 'collection'])->name('collection');
Route::get('/product', [SiteController::class, 'product'])->name('product');
Route::get('/product-details/{id}', [SiteController::class, 'productDetails'])->name('productDetails');


// Dashboard
Route::get('/dashboard', [DashboardController::class,'dashboardShow'])->name('admin.dashboard');

//Category Crud Route
Route::resource('/category', CategoryController::class);
Route::post('/category/mass-delete', [CategoryController::class, 'massDelete'])->name('category.massDelete');

//Color Crud Route
Route::resource('/color', ColorController::class);
Route::post('/color/mass-delete', [colorController::class, 'massDelete'])->name('color.massDelete');

//Size Crud Route
Route::resource('/size', SizeController::class);
Route::post('/size/mass-delete', [sizeController::class, 'massDelete'])->name('size.massDelete');

// //Product Image Crud Route
// Route::resource('productimage', ProductImageController::class);
// Route::post('/productimage/mass-delete', [ProductImageController::class, 'massDelete'])->name('productimage.massDelete');


// IProduct CRUD
Route::resource('iproduct', IProductController::class);
Route::post('/iproduct/mass-delete', [IProductController::class, 'massDelete'])->name('iproduct.massDelete');
Route::get('/cart', [SiteController::class, 'cart'])->name('cart');
Route::post('/add-to-cart/{id}', [SiteController::class, 'addToCart'])->name('addToCart');
Route::delete('/cart/{id}', [SiteController::class, 'removeFromCart'])->name('removeFromCart');
Route::delete('/cart/empty/all', [SiteController::class, 'emptyCart'])->name('emptyCart');
