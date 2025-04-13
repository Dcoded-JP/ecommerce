<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SizeController;
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


// test
Route::get('/dashboard', [DashboardController::class,'dashboardShow'])->name('admin.dashboard');

//Category Crud Route
Route::resource('/category', CategoryController::class);
//category.massDelete
Route::post('/category/mass-delete', [CategoryController::class, 'massDelete'])->name('category.massDelete');

//Color Crud Route
Route::resource('/color', ColorController::class);
//color.massDelete
Route::post('/color/mass-delete', [colorController::class, 'massDelete'])->name('color.massDelete');

//Size Crud Route
Route::resource('/size', SizeController::class);
//size.massDelete
Route::post('/size/mass-delete', [sizeController::class, 'massDelete'])->name('size.massDelete');


//Product Image Crud Route
Route::resource('/productimage', ProductImageController::class);
//productimage.massDelete
Route::post('/productimage/mass-delete', [ProductImageController::class, 'massDelete'])->name('productimage.massDelete');


