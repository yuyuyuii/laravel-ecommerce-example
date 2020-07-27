<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart; //コンポーザーで入れたshoppingcartのライブラリ

class SaveForLaterController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Cart::instance('saveForLater')->remove($id);
      // return redirect()->route('cart.index')->with('seccess_message', '商品を削除しました！');
      return back()->with('success_message', '商品を削除しました！');
    }

    /**
     * Switch item from Saved for Later to Cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToCart($id)
    {
      //カートに入れる商品IDを欲しいものリスト内から取得
      $item = Cart::instance('saveForLater')->get($id);
      // 取得したら欲しい物リスト内から削除
      Cart::instance('saveForLater')->remove($id);

      $dupulicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id){
        return $rowId === $id;
      });

      //もし欲しいものリスト内に同じ商品があったら
      if($dupulicates->isNotEmpty()){
        return redirect()->route('cart.index')->with('success_message', 'Item is already in your cart!');
      }      

      Cart::instance('default')->add($item->id, $item->name, 1,$item->price)
          ->associate('App\Product');

      return redirect()->route('cart.index')->with('success_message', 'Item has been Moved to Cart!');
    }
}
