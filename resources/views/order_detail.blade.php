@extends('layout')

@section('title', '購入履歴詳細')

@section('extra-css')

@endsection

@section('content') 

    <div class="breadcrumbs">
        <div class="container">
            <a href="/">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <a href="#">購入履歴詳細</a>
        </div>
        <div>
          @include('partials.search')
        </div>
        
    </div> <!-- end breadcrumbs -->
        @if( session()->has('success_message'))
          <div class="alert alert-success">
            {{ session()->get('success_message')}}
          </div>
        @endif
        @if( count($errors) > 0 )
        <div class="spacer"></div>
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)          
            <li>
              {!! $error !!} <!-- エスケープ解除 -->
            </li>
            @endforeach
          </ul>
        </div>
      @endif
    <div class="products-section my-orders container">

        <div class="sidebar">
          <ul>
            <li ><a href="{{ route('user.edit') }}">My Profile</a></li>
            <li class="active"><a href="{{ route('order.index') }}">注文履歴</a></li>
          </ul>
        </div> <!-- end sidebar -->

        <div class="my-profile">
          <div class="products-header">
            <h1 class="stylish-heading">Order ID: {{ $order->id }}</h1>
          </div>
          <div>
          <div class="order-container">
              <div class="order-header">
                  <div class="order-header-items">
                      <div>
                          <div class="uppercase font-bold">Order Placed</div>
                          <div>{{ $order->created_at }}</div>
                      </div>
                      <div>
                          <div class="uppercase font-bold">Order ID</div>
                          <div>{{ $order->id }}</div>
                      </div><div>
                          <div class="uppercase font-bold">Total</div>
                          <div>{{ presentPrice($order->billing_total) }}</div>
                      </div>
                  </div>
                  <div>
                      <div class="order-header-items">
                          <div><a href="#">Invoice</a></div>
                      </div>
                  </div>
              </div>
              <div class="order-products">
                  <table class="table" style="width:50%">
                      <tbody>
                          <tr>
                              <td>Name</td>
                              <td>{{ $order->user->name }}</td>
                          </tr>
                          <tr>
                              <td>Address</td>
                              <td>{{ $order->billing_address }}</td>
                          </tr>
                          <tr>
                              <td>City</td>
                              <td>{{ $order->billing_city }}</td>
                          </tr>
                          <tr>
                              <td>Subtotal</td>
                              <td>{{ presentPrice($order->billing_subtotal) }}</td>
                          </tr>
                          <tr>
                              <td>Tax</td>
                              <td>{{ presentPrice($order->billing_tax) }}</td>
                          </tr>
                          <tr>
                              <td>Total</td>
                              <td>{{ presentPrice($order->billing_total) }}</td>
                          </tr>
                      </tbody>
                  </table>

              </div>
          </div> <!-- end order-container -->
          <div class="order-container">
              <div class="order-header">
                  <div class="order-header-items">
                      <div>
                          Order Items
                      </div>

                  </div>
              </div>
              <div class="order-products">
                  @foreach ($products as $product)
                      <div class="order-product-item">
                          <div><img src="{{ productImage($product->image) }}" alt="Product Image"></div>
                          <div>
                              <div>
                                  <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                              </div>
                              <div>{{ presentPrice($product->price) }}</div>
                              <div>Quantity: {{ $product->pivot->quantity }}</div>
                          </div>
                      </div>
                  @endforeach

              </div>
          </div> <!-- end order-container -->
    </div>

@endsection
