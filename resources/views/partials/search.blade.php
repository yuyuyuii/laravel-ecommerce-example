<form action="{{ route('shop.search') }}" method="get" class="search-form">
  <input type="text" name="search" id="search" class="search-box" placeholder="検索" value="{{ request()->input('search')}}">
  <button>検索</button>
</form>

