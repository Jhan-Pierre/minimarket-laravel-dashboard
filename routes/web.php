<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('can:admin.dashboard')->name('admin.dashboard');

    Route::resource('users', UserController::class)->only('index', 'edit', 'update', 'create', 'store', 'delete', 'destroy', 'show')->middleware('can:admin.users.index')->names('admin.users');

    Route::resource('products', ProductController::class)->middleware('can:admin.product.index')->names('admin.product');

    Route::resource('categories', CategoryController::class)->middleware('can:admin.category.index')->names('admin.category');

    Route::resource('orders', OrderController::class)->middleware('can:admin.order.index')->names('admin.order');

    Route::resource('suppliers', SupplierController::class)->middleware('can:admin.supplier.index')->names('admin.supplier');

    Route::resource('sales', SaleController::class)->middleware('can:admin.sale.index')->names('admin.sale');

    Route::resource('contact', ContactController::class)->middleware('can:admin.contact')->names('admin.contact');

});
