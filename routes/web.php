<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});
Route::middleware(['auth','verified'])->group(function (){
    Route::controller(DashboardController::class)->group(function (){
        Route::get('/admin/dashboard','index');
    });
    Route::controller(CategoryController::class)->group(function (){
        Route::get('/admin/all-category','index')->name('allCategory');
        Route::get('/admin/add-category','addCategory')->name('addCategory');
    });
    Route::controller(SubCategoryController::class)->group(function (){
        Route::get('/admin/all-subCategory','index')->name('allSubCategory');
        Route::get('/admin/add-subCategory','addSubCategory')->name('addSubCategory');
    });
    Route::controller(ProductController::class)->group(function (){
        Route::get('/admin/all-product','index')->name('allProduct');
        Route::get('/admin/add-product','addProduct')->name('addProduct');
    });
    Route::controller(OrderController::class)->group(function (){
        Route::get('/admin/dashboard','index');
    });
});

require __DIR__.'/auth.php';
