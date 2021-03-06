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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::view('/', 'landing-page');
// Route::view('/shop', 'shop');
// Route::view('/product', 'product');
// Route::view('/cart', 'cart');
// Route::view('/cartsaved', 'cartsaved');
// Route::view('/checkout', 'checkout');
// Route::view('/thankyou', 'thankyou');

Route::get('/', 'LandingPageController@index')->name('landing-page');
Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::post('/cart/saveForLater/{product}', 'CartController@saveForLater')->name('cart.saveForLater');

Route::delete('/saveForLater/{product}', 'saveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/saveForLater/moveToCart/{product}', 'saveForLaterController@moveToCart')->name('saveForLater.moveToCart');


Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy');


Route::get('checkout', 'CheckoutController@index')->name('checkout.index')->middleware('auth');
Route::post('checkout', 'CheckoutController@store')->name('checkout.store');

Route::get('guestCheckout', 'CheckoutController@index')->name('guestCheckout.index');

Route::get('thankyou', 'thankyouController@index')->name('thankyou.index');

Route::get('empty', function () {
    Cart::instance('saveForLater')->destroy();
});

// Route::get('/', 'pagesController@index');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'ShopController@search')->name('search');
Route::get('/search-algolia', 'ShopController@searchAlgolia')->name('search-algolia');

Route::get('/mailable', function(){
    $order = App\Order::find(1);

    return new App\Mail\OrderPlaced($order);
});
