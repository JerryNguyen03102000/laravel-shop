<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\LoginController;
use \App\Http\Controllers\Admin\IndexController;
use \App\Http\Controllers\Admin\BrandController;
use \App\Http\Controllers\Admin\SliderController;
use \App\Http\Controllers\Admin\CategoryController;
use \App\Http\Controllers\Admin\ProductController;
use \App\Http\Controllers\Client\CartController;
use \App\Http\Controllers\Client\UserLoginController;
use \App\Http\Controllers\Client\CheckoutController;
use \App\Http\Controllers\Admin\OrderController;

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

Route::get('/', [\App\Http\Controllers\Client\IndexController::class, 'index'])->name('client-home');
Route::get('/category-{slug}', [\App\Http\Controllers\Client\IndexController::class, 'category'])->name('client-category');
Route::get('/brand-{slug}', [\App\Http\Controllers\Client\IndexController::class, 'brand'])->name('client-brand');
Route::get('/details-{slug}', [\App\Http\Controllers\Client\IndexController::class, 'details'])->name('client-details');
//  cart
Route::get('/show-cart', [CartController::class, 'show_cart'])->name('show_cart');
Route::post('/update-quantity-cart/{id}', [CartController::class, 'update_qty_cart'])->name('update-quantity_cart');
Route::get('/delete-cart/{id}', [CartController::class, 'delete_cart'])->name('delete_cart');
Route::post('/add-to-cart', [CartController::class, 'add_cart'])->name('add_to_cart');
Route::get('/delete-all-cart', [CartController::class, 'deleteAllCart'])->name('delete_all_cart');
// User Login and Register
Route::get('/user', [UserLoginController::class, 'login'])->name('view-user-login');
Route::post('/user/register', [UserLoginController::class, 'register'])->name('register');
Route::post('/user/login', [UserLoginController::class, 'CheckloginUser'])->name('user-login');
Route::get('/user-logout', [UserLoginController::class, 'userLogout'])->name('user-logout');
// Checkout
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('user-checkout');
Route::post('checkout/shipping', [CheckoutController::class, 'shipping'])->name('shipping');
Route::get('/thank', [CheckoutController::class, 'thank'])->name('thank');


// admin login
Route::get('admin-login', [LoginController::class, 'FormLogin'])->name('admin-login');
Route::post('admin-login', [LoginController::class, 'StoreLogin'])->name('store-login');
Route::get('admin-forgotPassword', [LoginController::class, 'FormForgot'])->name('form-forgot');
route::post('admin-forgotPassword', [LoginController::class, 'ShowResetLink'])->name('show-reset-link');
Route::get('admin/reset/{token}', [LoginController::class, 'ShowResetForm'])->name('reset-password-form');
Route::post('admin/reset-password', [LoginController::class, 'ResetPassword'])->name('reset-password');
// admin logout
Route::get('logout', [LoginController::class, 'Logout'])->name('logout');
// admin
route::prefix('admin')->middleware('check-login')->group(function () {
    // dashboard
    route::get('dashboard', [IndexController::class, 'dashboard'])->name('admin.dashboard');
    // brand
    route::get('brand', [BrandController::class, 'ShowListBrand'])->name('admin.brand');
    route::get('brand/create', [BrandController::class, 'CreateBrand'])->name('admin.brand.create-form');
    route::post('brand/create', [BrandController::class, 'StoreCreateBrand'])->name('admin.brand.create');
    route::get('brand/delete/{id}', [BrandController::class, 'Delete'])->name('admin.brand.delete');
    route::get('brand/edit/{id}', [BrandController::class, 'FormEditBrand'])->name('admin.brand.edit-form');
    route::post('brand/edit/{id}', [BrandController::class, 'EditBrand'])->name('admin.brand.edit');
    Route::get('brand/search', [BrandController::class, 'Search'])->name('admin.brand.search');
    // slider
    Route::get('slider', [SliderController::class, 'ListSlider'])->name('admin.slider');
    route::get('slider/create', [SliderController::class, 'CreateSlider'])->name('admin.slider.create-form');
    route::post('slider/create', [SliderController::class, 'StoreCreateSlider'])->name('admin.slider.create');
    route::get('slider/edit/{id}', [SliderController::class, 'FormEditSlider'])->name('admin.slider.edit-form');
    route::post('slider/edit/{id}', [SliderController::class, 'EditSlider'])->name('admin.slider.edit');
    route::get('slider/delete/{id}', [SliderController::class, 'Delete'])->name('admin.slider.delete');
    Route::get('slider/search', [SliderController::class, 'Search'])->name('admin.slider.search');
    // Category
    Route::get('category', [CategoryController::class, 'ListCategory'])->name('admin.category');
    route::get('category/create', [CategoryController::class, 'CreateCategory'])->name('admin.category.create-form');
    route::post('category/create', [CategoryController::class, 'StoreCreateCategory'])->name('admin.category.create');
    route::get('category/edit/{id}', [CategoryController::class, 'FormEditCategory'])->name('admin.category.edit-form');
    route::post('category/edit/{id}', [CategoryController::class, 'EditCategory'])->name('admin.category.edit');
    route::get('category/delete/{id}', [CategoryController::class, 'Delete'])->name('admin.category.delete');
    Route::get('category/search', [CategoryController::class, 'Search'])->name('admin.category.search');
    // product
    Route::get('product', [ProductController::class, 'ListProduct'])->name('admin.product');
    route::get('product/create', [ProductController::class, 'CreateProduct'])->name('admin.product.create-form');
    route::post('product/create', [ProductController::class, 'StoreCreateProduct'])->name('admin.product.create');
    route::get('product/edit/{id}', [ProductController::class, 'FormEditProduct'])->name('admin.product.edit-form');
    route::post('product/edit/{id}', [ProductController::class, 'EditProduct'])->name('admin.product.edit');
    route::get('product/delete/{id}', [ProductController::class, 'Delete'])->name('admin.product.delete');
    Route::get('product/search', [ProductController::class, 'Search'])->name('admin.product.search');
    // order
    Route::get('order', [OrderController::class, 'Order'])->name('admin.order');
    Route::get('order/details/{code_order}', [OrderController::class, 'orderDetails'])->name('admin.orderDetails');
    Route::get('order/details/delete/{id}', [OrderController::class, 'orderDelete'])->name('admin.orderDelete');
});

