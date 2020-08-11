<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //ユーザーの購入履歴を表示
      // ユーザーに紐づいた購入履歴を取得(hasMany, belongsToで定義済み)
      // $orders = auth()->user()->orders; // orderテーブルのレコード分クエリを発行してしまいn+1問題が起きるらしい。メソッドとしてではなくプロパティとして使うと取得可能。orders

      /**
       * withメソッドを使うと解決できる。orderプロパティではなくorder()メソッドとして使う
       * with()の引数にはリレーションで定義したbelongsToのproductsメソッドを指定する
       */
      $orders = auth()->user()->orders()->with('products')->get();
      return view('order')->with([
        'orders' => $orders,

      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
      // $order_detail = Order::where('id', $id);
      // return view('order_detail')->with([
      //   'order_detail' => $order_detail,
      // ]);
        if (auth()->id() !== $order->user_id) {
            return back()->withErros('You do not have access to this!');
        }

        $products = $order->products;

        return view('order_detail')->with([
            'order' => $order,
            'products' => $products,
        ]);
    }

}