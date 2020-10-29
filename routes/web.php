<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'FrontPageController@index')->name('front');
Route::get('/product/{id}', 'FrontPageController@show')->name('products.show');
Route::get('/category/{slug}', 'FrontPageController@filterProducts')->name('products.filter');
Route::get('view/products', 'FrontPageController@viewAllProducts')->name('products.viewAll');

Route::get('/add-to-cart/{product}', 'CartController@addToCart')->name('cart.add');
Route::get('/cart', 'CartController@showCart')->name('cart.show');
Route::post('/update-cart/{product}', 'CartController@updateCart')->name('cart.update');
Route::post('/remove-cart/{product}', 'CartController@removeCart')->name('cart.remove');
Route::get('/checkout/{amount}', 'CartController@checkout')->name('cart.checkout')->middleware('auth');
Route::post('/charge', 'CartController@charge')->name('cart.charge');
Route::get('/orders', 'CartController@orders')->name('orders')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'auth', 'middleware' => ['auth', 'is_admin']], function () {
    Route::get('/dashboard', function () {
        $activeMenu = 'home';
        $activeSubMenu = '';
        return view('admin.dashboard', compact('activeMenu', 'activeSubMenu'));
    })->name('dashboard');

    /********** ajax ***************/
    Route::get('subcategories/{id}', 'ProductController@loadSubCategories');

    Route::resource('category', 'CategoryController');
    Route::resource('sub-category', 'SubCategoryController');
    Route::resource('product', 'ProductController');

    Route::get('slider', 'SliderController@index')->name('slider.index');
    Route::get('slider/create', 'SliderController@create')->name('slider.create');
    Route::post('slider', 'SliderController@store')->name('slider.store');
    Route::delete('slider/{id}', 'SliderController@destroy')->name('slider.destroy');

    Route::get('users', 'UserController@index')->name('users.index');
    // Route::get('orders', 'CartController@userOrders')->name('users.orders');
    Route::get('orders/{id}', 'CartController@viewUserOrder')->name('users.view.orders');
});
