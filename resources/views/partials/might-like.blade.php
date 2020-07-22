<div class="might-like-section">
    <div class="container">
        <h2>You might also like...</h2>
        <div class="might-like-grid">
          @foreach( $mightAlsoLikes as $mightAlsoLike)
            <a href="{{ route('shop.show', $mightAlsoLike->slug) }}" class="might-like-product">
                <img src="{{ asset('img/macbook-pro.png') }}" alt="product">
                <div class="might-like-product-name">{{ $mightAlsoLike->name }}</div>
                <div class="might-like-product-price">{{ $mightAlsoLike->presentPrice() }}</div>
            </a>
          @endforeach 

        </div>
    </div>
</div>
