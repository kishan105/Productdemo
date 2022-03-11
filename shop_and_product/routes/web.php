<?php

use App\Http\Controllers\Admin\productController;
use App\Http\Controllers\Admin\shopController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('index');

Route::prefix('admin')->group(function () {

    #shop crud
    Route::get('shop',[shopController::class,"list"])->name('shop');
    Route::get('shop/add',[shopController::class,"add"])->name('shopAdd');
    Route::post('shop/store',[shopController::class,"store"])->name('shopStore');
    Route::get('shop/edit/{id}',[shopController::class,"edit"])->name('shopEdit');
    Route::post('shop/update/{id}',[shopController::class,"update"])->name('shopUpdate');
    Route::get('shop/delete/{id}',[shopController::class,"delete"])->name('shopDelete');

    Route::get('export',[shopController::class,"export"])->name('export');
    Route::post('import',[shopController::class,"import"])->name('import');


    #product crud
    Route::get('product',[productController::class,"list"])->name('product');
    Route::get('product/add',[productController::class,"add"])->name('productAdd');
    Route::post('product/store',[productController::class,"store"])->name('productStore');
    Route::get('product/edit/{id}',[productController::class,"edit"])->name('productEdit');
    Route::post('product/update/{id}',[productController::class,"update"])->name('productUpdate');
    Route::get('product/delete/{id}',[productController::class,"delete"])->name('productDelete');

    Route::get('exportproduct',[productController::class,"exportproduct"])->name('exportproduct');
    Route::post('importproduct',[productController::class,"importproduct"])->name('importproduct');
});
