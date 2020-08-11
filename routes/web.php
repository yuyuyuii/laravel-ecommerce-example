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
//カート内に入れた商品の個数を更新
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');

//欲しいものリスト
Route::post('/cart/switchToSaveForLater/{product}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

Route::delete('/saveForlater/{product}', 'saveForlaterController@destroy')->name('saveForlater.destroy');
Route::post('/saveForlater/switchToCart/{product}', 'saveForlaterController@switchToCart')->name('saveForlater.switchToCart');

//カート内削除
Route::get('/empty', function(){
  // Cart::destroy();  
  Cart::instance('saveForLater')->destroy();  
});

//coupon
Route::post('/coupon', 'CouponsController@store')->name('coupon.store'); //coupon使用
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy');

// 決済画面
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index')->middleware('auth'); //決済ボタンを押した際、ユーザーがログインしていなければ、ログイン画面へ遷移する
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');

// ゲストで購入する場合のルーティング
Route::get('/guestCheckout', 'CheckoutController@index')->name('guestCheckout.index');

//購入完了画面
Route::get('/thankyou', 'ConfirmationController@index')->name('confirmation.index');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

//検索
Route::get('/search', 'ShopController@search')->name('shop.search');

//mypage
// Route::get('/mypage/{id}', 'UsersController@edit')->name('user.edit');
Route::middleware('auth')->group(function(){
  Route::get('/mypage', 'UsersController@edit')->name('user.edit');
  Route::patch('/mypage', 'UsersController@update')->name('user.update');
  Route::get('/orders', 'OrdersController@index')->name('order.index');
  Route::get('/orders/{order}', 'OrdersController@show')->name('order.show');  
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
