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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('logout', 'Auth\LoginController@logout')->name('user.logout');

Route::get('/users', 'AdminController@users')->name('users');
Route::get('/suppliers', 'AdminController@suppliers')->name('suppliers');

Route::resource('/products', 'ProductController', ['names' => 'product']);

// admin
Route::group(['prefix'=>'admin'], function() {
	Route::get('/', 'AdminController@index')->name('admin.home');
	Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Admin\Auth\LoginController@login')->name('admin.login.submit');

	Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
});

// supplier
Route::group(['prefix'=>'supplier'], function() {
	Route::get('/', 'SupplierController@index')->name('supplier.home');
	Route::get('/login', 'Supplier\Auth\LoginController@showLoginForm')->name('supplier.login');
	Route::post('/login', 'Supplier\Auth\LoginController@login')->name('supplier.login.submit');

	Route::post('logout', 'Supplier\Auth\LoginController@logout')->name('supplier.logout');

	Route::get('/register', 'Supplier\Auth\RegisterController@showRegisterForm')->name('supplier.register');
	Route::post('/register', 'Supplier\Auth\RegisterController@register')->name('supplier.register.submit');

});

