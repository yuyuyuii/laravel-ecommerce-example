@extends('layout')

@section('title', 'Products')

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="/">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <a href="{{ route('shop.index')}}">Shop</a>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="products-section container">
        <div class="sidebar">
            <h3>By Category</h3>
            <ul>
              @foreach($categories as $category)
                <!-- <li class="{{ request()->category == $category->slug ? 'active' : '' }}"><a href="{{ route('shop.index', [ 'category' => $category->slug]) }}">{{ $category->name }}</a></li> --> 
                <li class="{{ setActiveCategory($category->slug) }}"><a href="{{ route('shop.index', [ 'category' => $category->slug]) }}">{{ $category->name }}</a></li> <!-- helper.phpに記載し、メソッド化する事ですっきりする感じ-->
              @endforeach
            </ul>

            <!-- <h3>By Price</h3>
            <ul>
                <li><a href="#">$0 - $700</a></li>
                <li><a href="#">$700 - $2500</a></li>
                <li><a href="#">$2500+</a></li>
            </ul> -->
        </div> <!-- end sidebar -->
        <div>
          <div class="products-header">
            <h1 class="stylish-heading">{{ $categoryName }}</h1>
            <div>
              <strong>Price</strong>
              <a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'low_high']) }}">価格が低い順</a>｜
              <a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'high_low']) }}">価格が高い順</a>
            </div>            
          </div>

            <div class="products text-center">
              @forelse($products as $product)
                <div class="product">
                    <!-- <a href="/shop/{{$product->slug }}"><img src="/img/macbook-pro.png" alt="product"></a> -->
                    <a href="{{ route('shop.show', $product->slug) }}"><img src="/img/macbook-pro.png" alt="product"></a>
                    <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name"> {{ $product->name }} </div></a>
                    <div class="product-price"> {{ $product->presentPrice() }} </div>
                </div>
              @empty
                <div style="text-align:left">商品が見つかりません</div>
              @endforelse
            </div> <!-- end products -->
            <!-- //{{ $products->links() }} -->
            <!-- ページを移動するとソートがリセットされてしまうので、以下に変更 -->
            {{ $products->appends(request()->input())->links() }}

        </div>
    </div>


@endsection
