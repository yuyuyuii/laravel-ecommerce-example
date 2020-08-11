<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart; //コンポーザーで入れたshoppingcartのライブラリ
use Illuminate\Support\Facades\Validator;
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
      $dupulicates = Cart::search(function ($cartItem, $rowId) use ($request){
        return $cartItem->id === $request->id;
      });

      //もしカート内に同じ商品があったら
      if($dupulicates->isNotEmpty()){
        return redirect()->route('cart.index')->with('success_message', 'Item is already in your cart!');
      }

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
      //個数のバリデーション
      $validator = Validator::make($request->all(),[
        'quantity' => 'required|numeric|between:1,5',
      ]);
      if($validator->fails()){
        session()->flash('errors', collect(['1個から5個の間で選んでください。']));
        return response()->json(['success' => false], 400);
      }

      if($request->quantity > $request->productQuantity){
        session()->flash('errors', collect(['在庫切れです。']));
        return response()->json(['success' => false], 400);
      }

      //カート内で商品の個数が変更されたら
      Cart::update($id, $request->quantity);
      session()->flash('success_message', '個数を変更しました！');

      return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Cart::remove($id);
      // return redirect()->route('cart.index')->with('seccess_message', '商品を削除しました！');
      return back()->with('success_message', '商品を削除しました！');
    }
    /**
     * Switch item for shopping cart to Save for later.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToSaveForLater($id)
    {
      //欲しいものリストに入れる商品IDをカート内から取得
      $item = Cart::get($id);
      // 取得したらカート内から削除(欲しいものリストに移動させるイメージ)
      Cart::remove($id);

      $dupulicates = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id){
        return $rowId === $id;
      });

      //もし欲しいものリスト内に同じ商品があったら
      if($dupulicates->isNotEmpty()){
        return redirect()->route('cart.index')->with('success_message', 'Item is already in your cart!');
      }      

      Cart::instance('saveForLater')->add($item->id, $item->name, 1,$item->price)
          ->associate('App\Product');

      return redirect()->route('cart.index')->with('success_message', 'Item has been Saved For Later!');
    }

}
