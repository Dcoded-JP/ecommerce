<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SizeController;
use Illuminate\Support\Facades\Route;

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
Route::view('/dashboard', 'Backend.Dashboard.dashboard');

//Category Crud Route
Route::resource('/category', CategoryController::class);
//category.massDelete
Route::post('/category/mass-delete', [CategoryController::class, 'massDelete'])->name('category.massDelete');

//Color Crud Route
Route::resource('/color', ColorController::class);

//Size Crud Route
Route::resource('/size', SizeController::class);


