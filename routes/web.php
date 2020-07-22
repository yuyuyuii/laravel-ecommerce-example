<?php

// Route::view('/', 'landing-page');
Route::get('/', 'LandingPageController@index')->name('landing-page');
Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');
// Route::view('/product', 'product');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
// Route::view('/cart', 'cart');
Route::view('/checkout', 'checkout');
Route::view('/thankyou', 'thankyou');
