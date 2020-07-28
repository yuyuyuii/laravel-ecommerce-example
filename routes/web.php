<?php

// Route::view('/', 'landing-page');
Route::get('/', 'LandingPageController@index')->name('landing-page');
Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');
// Route::view('/product', 'product');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
//商品を１つだけ削除
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
//欲しいものリスト
Route::post('/cart/switchToSaveForLater/{product}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

Route::delete('/saveForlater/{product}', 'saveForlaterController@destroy')->name('saveForlater.destroy');
Route::post('/saveForlater/switchToCart/{product}', 'saveForlaterController@switchToCart')->name('saveForlater.switchToCart');

//カート内削除
Route::get('/empty', function(){
  // Cart::destroy();  
  Cart::instance('saveForLater')->destroy();  
});

// Route::view('/cart', 'cart');
// 決済画面
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
// Route::view('/checkout', 'checkout');
Route::view('/thankyou', 'thankyou');
