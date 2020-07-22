<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart; //コンポーザーで入れたshoppingcartのライブラリ
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //カートにもレコメンドを表示させる
      // $mightAlsoLikes = Product::inRandomOrder()->take(4)->get();
      $mightAlsoLikes = Product::mightAlsoLike()->get(); //上の処理を使い回すので関数をproductモデルに作成
      return view('cart')->with('mightAlsoLikes', $mightAlsoLikes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Cart::add($request->id, $request->name, 1,$request->price)
          ->associate('App\Product');
      return redirect()->route('cart.index')->with('success_message', '商品をカートに入れました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
