<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
      $coupon = Coupon::where('code', $request->coupon_code)->first();

      if(!$coupon){//クーポンが存在しなかったらエラー処理
        return redirect()->route('checkout.index')->withErrors('入力されたクーポンは存在しません。もう一度入力してください。');
      }

      //sessionにcouponと言う名前で保存して、viewで呼び出す
      session()->put('coupon', [
        'name' => $coupon->code,
        'discount' => $coupon->discount(Cart::subtotal()), //modelに定義したdiscount()
      ]);

      return redirect()->route('checkout.index')->with('success_message', 'クーポンを使用しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
      session()->forget('coupon');
      return redirect()->route('checkout.index')->with('success_message', 'クーポンを削除しました。');
    }
}
