<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(request()->category){ //viewから送られてきたら、categoryのslugが取得できる
        $products = Product::with('categories')->whereHas('categories', function($query) { //テーブル結合してviewから送られてきたslug名がDBと一致するものを取得し、返却。
          $query->where('slug', request()->category);
        })->get();
        $categories = Category::all();
        //shop画面から送られてきたカテゴリ名を使ってカテゴリの中からslugの名前を取得。
        $categoryName =$categories->where('slug', request()->category)->first()->name;

      }else{
      //ランディングページを同じものを表示
      $products = Product::inRandomOrder()->take(12)->get(); 
      //カテゴリの一覧を表示
      $categories = Category::all();
      $categoryName = 'Featured';
      }

      //値段ソート
      if(request()->sort == 'low_high'){ 
        $products = $products->sortBy('price'); //低い順
      }elseif(request()->sort == 'high_low'){
        $products = $products->sortByDesc('price'); //高い順
      }

      return view('shop')->with([
        'products' => $products,
        'categories' => $categories,
        'categoryName' => $categoryName,
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug //$idから$slugに変更
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      // 商品詳細ページ
      // $product = Product::find($slug);
      $product = Product::where('slug', $slug)->firstOrFail();
      //page下のレコメンド
      // $mightAlsoLikes = Product::where('slug', '!=', $slug)->inRandomOrder()->take(4)->get(); //現在取得しているslug以外でランダムで4つ取得
      $mightAlsoLikes = Product::where('slug', '!=', $slug)->mightAlsoLike()->get(); //作成した関数に変更
      return view('product')->with([ //配列で渡すときは、カンマ区切りではなく=>を使う
        'product' => $product,
        'mightAlsoLikes' => $mightAlsoLikes,
        ]);
      // return view('product')->with('product', $product);
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
