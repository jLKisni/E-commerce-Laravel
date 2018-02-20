<?php


// Landing Page Controller
Route::get('/','LandingPageController@index')->name('landing-page');


// Shop View Controller
Route::get('/shop','ShopController@index')->name('shop.index');
Route::get('/shop/{product}','ShopController@show')->name('shop.show');


// Cart View Controller

Route::get('/cart','CartController@index')->name('cart.index');
Route::post('/cart','CartController@store')->name('cart.store');
Route::get('/removeCart','CartController@removeCart')->name('cart.removeCart');

