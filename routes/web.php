<?php

// Route::view('/', 'landing-page');
Route::get('/', 'LandingPageController@index');
Route::view('/products', 'products');
Route::view('/product', 'product');
Route::view('/cart', 'cart');
Route::view('/checkout', 'checkout');
Route::view('/thankyou', 'thankyou');
