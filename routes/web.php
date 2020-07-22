<?php

// Route::view('/', 'landing-page');
Route::get('/', 'LandingPageController@index');
Route::view('/shop', 'shop');
Route::view('/product', 'product');
Route::view('/cart', 'cart');
Route::view('/checkout', 'checkout');
Route::view('/thankyou', 'thankyou');
