<?php


// Landing Page Controller
Route::get('/','LandingPageController@index')->name('landing-page');


// Shop View Controller
Route::get('/shop','ShopController@index')->name('shop.index');
Route::get('/shop/{product}','ShopController@show')->name('shop.show');


// Cart View Controller

Route::get('/cart','CartController@index')->name('cart.index');
Route::post('/cart','CartController@store')->name('cart.store');
Route::patch('/cart/{product}','CartController@update')->name('cart.update');
Route::delete('/cart/{product}','CartController@destroy')->name('cart.destroy');
Route::get('/removeCart','CartController@removeCart')->name('cart.removeCart');
Route::post('/cart/SaveForLater/{product}','CartController@SaveForLater')->name('cart.SaveForLater');

// Save Later Controller

Route::delete('/savelater/{product}', 'SaveLaterController@destroy')->name('savelater.destroy');\
Route::post('/tocart/{product}','SaveLaterController@toCart')->name('tocart.addToCart');


// Checkout Controller

Route::get('/checkout','CheckoutController@index')->name('checkout.index');
Route::post('/checkout','CheckoutController@store')->name('checkout.store');


// Confirmation Controller

Route::get('/confirm','ConfirmationController@index')->name('confirm.index');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
