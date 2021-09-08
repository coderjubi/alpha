<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/about', [FrontendController::class, 'about']);
Route::get('/contact', [FrontendController::class, 'contact']);
Route::get('/', [FrontendController::class, 'welcome']);

//Category Routes
Route::get('/addcategory', [CategoryController::class, 'index']);
Route::post('/category/insert', [CategoryController::class, 'insert']);
Route::get('/category/delete/{category_id}', [CategoryController::class, 'delete']);

// subcategory
Route::get('/subcategory', [SubcategoryController::class, 'index']);
Route::post('/subcategory/insert', [SubcategoryController::class, 'insert']);
Route::get('/subcategory/delete/{subcategory_id}', [SubcategoryController::class, 'delete']);
Route::get('/subcategory/edit/{subcategory_id}', [SubcategoryController::class, 'edit']);
Route::post('/subcategory/update', [SubcategoryController::class, 'update']);
Route::get('/subcategory/restore/{deleted_subcategory_id}', [SubcategoryController::class, 'restore']);
Route::get('/subcategory/perdelete/{deleted_subcategory_id}', [SubcategoryController::class, 'perdelete']);
Route::post('/subcategory/markdelete', [SubcategoryController::class, 'markdelete']);

//profile
Route::get('/profile/edit', [ProfileController::class, 'profileedit']);
Route::post('/profile/namechange', [ProfileController::class, 'namechange']);
Route::post('/profile/passchange', [ProfileController::class, 'passchange']);
Route::post('/profile/photochange', [ProfileController::class, 'photochange']);

// Products
Route::get('/products', [ProductController::class, 'index']);
Route::post('/product/insert', [ProductController::class, 'insert']);
