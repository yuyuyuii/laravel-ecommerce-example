<div class="might-like-section">
    <div class="container">
        <h2>You might also like...</h2>
        <div class="might-like-grid">
          @foreach( $mightAlsoLikes as $mightAlsoLike)
            <a href="{{ route('shop.show', $mightAlsoLike->slug) }}" class="might-like-product">
                <!-- @if($mightAlsoLike->image)
                  <img src="{{ asset('storage/'. $mightAlsoLike->image) }}" alt="product">
                @else
                  <img src="{{asset('img/noimage.png') }}" alt="product">
                @endif -->
                <img src="{{ productImage($mightAlsoLike->image) }}" alt="" srcset="">
                <div class="might-like-product-name">{{ $mightAlsoLike->name }}</div>
                <div class="might-like-product-price">{{ $mightAlsoLike->presentPrice() }}</div>
            </a>
          @endforeach 

        </div>
    </div>
</div>
