<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
// use Stripe\Stripe;
// use Stripe\Charge;
// use Cartalyst\Stripe\Stripe;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $tax = config('cart.tax') / 100; //10 / 100 = 0.10
      // $discount = session()->get('coupon')['discount'] ?? 0; //クーポンがあればその額、なければ0
      // $newSubtotal = (Cart::subtotal() - $discount); //カートの中身から割引額を引く
      // $newTax = $newSubtotal * $tax; //割引した額の税金を取得
      // $newTotal = $newSubtotal * (1 + $tax);//割引した本体価格に割引後の税金をかける *1.10

      if (Cart::instance('default')->count() == 0) { //カート内が空っぽだったらshop.indexへ遷移
          return redirect()->route('shop.index');
        }

        if (auth()->user() && request()->is('guestCheckout')) {//ログインユーザーが/guestCheckoutにアクセスしたら、checkoutにリダイレクトさせる
            return redirect()->route('checkout.index');
        }
      // 上のやつをprivateメソッドにしてリファクタリング
      return view('checkout')->with([
        'discount' => $this->getNumbers()->get('discount'),//下に定義privateメソッド経由から取得する
        'newSubTotal' => $this->getNumbers()->get('newSubTotal'),
        'newTotal' => $this->getNumbers()->get('newTotal'),
        'newTax' => $this->getNumbers()->get('newTax'),
        ]);
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
    public function store(CheckoutRequest $request)
    {
      $contents = Cart::content()->map(function($item){
        return $item->model->slug. ','.$item->qty;
      })->values()->toJson();

        try {
            $charge = Stripe::charges()->create([
                // 'amount' => Cart::total() / 100,
                'amount' => $this->getNumbers()->get('newTotal') / 100, //クーポン機能に対応させる
                'currency' => 'CAD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                  //stripeの管理画面のmeta-dataへ登録する項目。登録しないのであれば、追加する必要はない
                    //change to Order ID after we start using DB
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(), //クーポン情報を追加
                ], 
            ]);

        // 成功したらカートの中身を削除し、決済完了画面へ
        Cart::instance('default')->destroy();
        //使用したクーポンコードも削除
        session()->forget('coupon');
        // return back()->with('success_message', '決済完了しました！');
        return redirect()->route('confirmation.index')->with('success_message','決済完了しました！' );
      } catch (CardErrorException $e) {
        return back()->withErrors('Error!'.$e->getMessage());
      }
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

    private function getNumbers()
    {
      $tax = config('cart.tax') / 100; //10 / 100 = 0.10 config/cart.phpのtaxの値
      $discount = session()->get('coupon')['discount'] ?? 0; //クーポンがあればその額、なければ0
      $newSubtotal = (Cart::subtotal() - $discount); //カートの中身(本体額)から割引額を引く
      $newTax = $newSubtotal * $tax; //割引した額の税金を取得
      $newTotal = $newSubtotal * (1 + $tax);//割引した本体価格に割引後の税金をかける *1.10

      return collect([
        'tax' => $tax,
        'discount' => $discount,
        'newSubTotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
      ]);
    }
}
