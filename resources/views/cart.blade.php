@extends('layout')

@section('title', 'Shopping Cart')

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="#">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Shopping Cart</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="cart-section container">
        <div>
            @if( session()->has('success_message'))
              <div class="alert alert-success">
                {{ session()->get('success_message')}}
              </div>
            @endif

            @if( count($errors) > 0)
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $error)
                    <li>
                      {{ $error}}
                    </li>
                  @endforeach
                </ul>
              </div>
            @endif

            @if(Cart::count() > 0)
              <h2>{{ Cart::count()}} item(s) in Shopping Cart</h2>


            <div class="cart-table">
              @foreach( Cart::content() as $item)
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                        <a href="{{ route('shop.show', $item->model->slug) }}"><img src="/img/macbook-pro.png" alt="item" class="cart-table-img"></a> <!-- $item->model->name でmodelを指定して値が取得できる-->
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                            <div class="cart-table-description">{{ $item->model->details }}</div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                        <div class="cart-table-actions">
                            <!-- <a href="#">Remove</a> <br> -->
                            <!-- <form action="{{ route('cart.destroy', $item->model->id) }}" method="post"> これだとカートに入れた商品IDが取れない--> 
                            <?php //dd($item); rowIdって言う文字列が追加されているから、それを指定しないと削除できない感じ?>
                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="post">
                              {{ csrf_field() }}
                              {{ method_field('delete') }}
                              <button type="submit" class="cart-options">remove</button>
                            </form>

                            <form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="post">
                              {{ csrf_field() }}
                              <button type="submit" class="cart-options">Save For Later</button>
                            </form>
                        </div>
                        <div>
                            <select class="quantity" data-id="{{ $item->rowId }}"><!-- data属性に商品IDを指定するとJSで商品IDが取れるようになる-->
                            @for($i = 1; $i <= 5; $i++)
                              <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }} </option>
                            @endfor
                            </select>
                        </div>
                        <!-- <div>//{{ $item->model->presentPrice() }}</div> -->
                        <!-- 個数を変更したら値段も変更される -->
                        <div>{{ presentPrice($item->subtotal)}}</div>
                    </div>
                </div> <!-- end cart-table-row -->
              @endforeach
            </div> <!-- end cart-table -->

            <a href="#" class="have-code">Have a Code?</a>

            <div class="have-code-container">
                <form action="#">
                    <input type="text">
                    <button type="submit" class="button button-plain">Apply</button>
                </form>
            </div> <!-- end have-code-container -->

            <div class="cart-totals">
                <div class="cart-totals-left">
                    Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like figuring out :).
                </div>

                <div class="cart-totals-right">
                    <div>
                        Subtotal <br>
                        Tax(10%) <br>
                        <span class="cart-totals-total">Total</span>
                    </div>
                    <div class="cart-totals-subtotal">
                    <!-- カート内のすべてのアイテムの合計から、税金の合計額を差し引いて取得 -->
                        <!-- //{{Cart::subtotal() / 100 }} <br> ヘルパーを作成し、関数化-->
                        {{ presentPrice(Cart::subtotal()) }} <br>
                        <!-- 価格と数量を指定して、カート内のすべてのアイテムの計算された税額を取得。プラスされる税金 -->
                        <!-- //{{Cart::tax() / 100 }} <br> -->
                        {{ presentPrice(Cart::tax()) }} <br>
                        <!-- 価格と数量を指定して、カート内のすべてのアイテムの計算された合計を取得。税込価格 -->
                        <!-- <span class="cart-totals-total">//{{ Cart::total() /100 }}</span> -->
                        <span class="cart-totals-total">{{ presentPrice(Cart::total()) }}</span>
                    </div>
                </div>
            </div> <!-- end cart-totals -->

            <div class="cart-buttons">
                <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a>
                <a href="{{ route('checkout.index') }}" class="button-primary">Proceed to Checkout</a>
            </div>
            @else
              <h3>no items in cart! </h3>

              <div class='spacer'></div>
              <a href="{{ route('shop.index')}}" class="button">Continue Shopping</a>
              <div class='spacer'></div>

            @endif

            @if(Cart::instance('saveForLater')->count() > 0)

            <h2>{{ Cart::instance('saveForLater')->count()}} item(s) in Saved for Later</h2>

            <div class="saved-for-later cart-table">
              @foreach( Cart::instance('saveForLater')->content() as $item)
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                        <a href="{{ route('shop.show', $item->model->slug) }}"><img src="/img/macbook-pro.png" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }} </a></div>
                            <div class="cart-table-description">{{ $item->model->details }}</div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                        <div class="cart-table-actions">
                            <!-- <a href="#">Remove</a> <br>
                            <a href="#">Move to Cart</a> -->
                            <form action="{{ route('saveForlater.destroy', $item->rowId) }}" method="post">
                              {{ csrf_field() }}
                              {{ method_field('delete') }}
                              <button type="submit" class="cart-options">Remove</button>
                            </form>

                            <form action="{{ route('saveForlater.switchToCart', $item->rowId) }}" method="post">
                              {{ csrf_field() }}
                              <button type="submit" class="cart-options">Move to Cart</button>
                            </form>
                        </div>

                        <!-- {{-- <div>
                            <select class="quantity">
                                <option selected="">1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div> --}} -->
                        <div>{{ $item->model->presentPrice() }}</div>
                    </div>
                </div> <!-- end cart-table-row -->
              @endforeach

            </div> <!-- end saved-for-later -->

            @else
            <h3>You have no items Saved for Later </h3>

            @endif

        </div>

    </div> <!-- end cart-section -->

    @include('partials.might-like')


@endsection

@section('extra-js')
<!-- axiosを使うためにimport -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
  (function(){
    //カート内の商品の個数のselectorを配列で全て取得
    const classname = document.querySelectorAll('.quantity');
    Array.from(classname).forEach(function(element){
      //.quantityの値が変化したら
      element.addEventListener('change', function(){
        // alert('change');
        //商品IDを取得
        const id = element.getAttribute('data-id');
        axios.patch(`/cart/${id}`, {
          quantity: this.value //quantityの値
        })
        .then(function (response) {
          // console.log(response);
          window.location.href = '{{ route('cart.index') }}'
        })
        .catch(function (error) {
          console.log(error);
          window.location.href = '{{ route('cart.index') }}'
        });
      })
    })

  })();
</script>

@endsection