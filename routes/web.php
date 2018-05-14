<?php

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

Route::get('/', 'clientsideController@home');
Route::get('contact', 'clientsideController@contact');
Route::post('drop-message', 'clientsideController@dropMessage');
// error Fix
Route::get('logout', 'clientsideController@logoutErrorFix');

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/


Route::get('products/product/{slug}', 'clientsideController@showProduct');
Route::get('products/category/{name}', 'clientsideController@productsInCategory');
Route::get('products/type/{type}', 'clientsideController@productsType');
Route::post('products/search', 'clientsideController@searchProduct');
Route::post('products/add-to-cart', 'clientsideController@addToCart');
Route::get('products/show-cart', 'clientsideController@showCart');
Route::post('products/remove-from-cart', 'clientsideController@removeFromCart');
Route::post('products/update-cart', 'clientsideController@updateCart');
Route::get('products/show-cart/place-order', 'clientsideController@placeOrder');
/*
|--------------------------------------------------------------------------
| Client Login Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

Route::get('login/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{service}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('home', 'HomeController@index')->name('home');
Route::post('home/update-profile', 'HomeController@updateProfile');

Route::get('verifyEmail', 'Auth\RegisterController@verifyEmail')->name('verifyEmail');
Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@emailSent')->name('emailSent');
/*
|--------------------------------------------------------------------------
| Admin Section Routes
|--------------------------------------------------------------------------
*/
Route::get('admin/home','AdminController@index');
Route::get('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin','Admin\LoginController@Login');
// These Routes are not Required Yet
// Route::post('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
// Route::get('admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
// Route::post('admin-password/reset','Admin\ResetPasswordController@reset');
// Route::get('admin-password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

// Credentials Routes
Route::get('admin/showcredentials','AdminController@showCredentials');
Route::post('admin/savecredentials','AdminController@saveCredentials');
// Categories Routes
Route::get('admin/categories', 'AdminController@showCategories');
Route::post('admin/add-category', 'AdminController@addCategory');
Route::post('admin/update-category', 'AdminController@updateCategory');
Route::post('admin/delete-category', 'AdminController@deleteCategory');
// Products Routes
Route::get('admin/products', 'AdminController@showProducts');
Route::post('admin/add-product', 'AdminController@addProduct');
Route::post('admin/update-product', 'AdminController@updateProduct');
Route::post('admin/delete-product', 'AdminController@deleteProduct');

// Order Routes
Route::post('admin/order-completed', 'AdminController@markOrderAsCompleted');
Route::post('admin/order-incomplete', 'AdminController@markOrderAsInComplete');
