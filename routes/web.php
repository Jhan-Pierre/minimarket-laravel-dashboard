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
    })->name('admin.dashboard');

    Route::resource('users', UserController::class)->only('index', 'edit', 'update', 'create', 'store', 'delete', 'destroy')->middleware('can:admin.users.index')->names('admin.users');

    Route::resource('products', ProductController::class)->names('admin.product');

    Route::resource('categories', CategoryController::class)->names('admin.category');

    Route::resource('orders', OrderController::class)->names('admin.order');

    Route::resource('suppliers', SupplierController::class)->names('admin.supplier');

    Route::resource('sales', SaleController::class)->names('admin.sale');

    Route::resource('contact', ContactController::class)->names('admin.contact');

});
