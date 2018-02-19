<?php


// Landing Page Controller
Route::get('/','LandingPageController@index')->name('landing-page');


// Shop View Controller
Route::get('/shop','ShopController@index')->name('shop.index');
Route::get('/shop/{product}','ShopController@show')->name('shop.show');
