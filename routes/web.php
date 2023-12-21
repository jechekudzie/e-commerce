<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Routes for CategoryController
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/admin/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


Route::get('/admin/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/admin/brands/create', [BrandController::class, 'create'])->name('brands.create');
Route::post('/admin/brands', [BrandController::class, 'store'])->name('brands.store');
Route::get('/admin/brands/{brand}', [BrandController::class, 'show'])->name('brands.show');
Route::get('/admin/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
Route::put('/admin/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
Route::delete('/admin/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');

// Create a product
Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');
// Display the form to create a product
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');
// Display a specific product
Route::get('/admin/products/{product}', [ProductController::class, 'show'])->name('products.show');
// Update a specific product
Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('products.update');
// Display the form to edit a specific product
Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Delete a specific product
Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
// Display all products
Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/admin', [AdminController::class,'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
