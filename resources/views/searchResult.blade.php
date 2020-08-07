@extends('layout')
@section('title', '検索結果')

@section('extra-css')
@endsection


@section('content')
<div class="breadcrumbs">
    <div class="container">
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <a href="{{ route('shop.index')}}">Shop</a>
    </div >
      
    <div style="float:right">
      @include('partials.search')
    </div>

</div> <!-- end breadcrumbs -->

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
<div class="search-section container">
  <h1>検索結果</h1>
  <p>"{{request()->input('search') }}"での検索 <span>{{ $results->total() }}件</span></p>

  <table class="table table-bordered table-striped">
    @foreach($results as $result)
      <tr>
      <th>Name</th>
      <th>Details</th>
      <th>Description</th>
      <th>Price</th>
      </tr>
      <tr>
      <td><a href="{{ route('shop.show', $result->slug) }}">{{ $result->name }}</a></td>
      <td>{{ $result->details }}</td> 
      <td>{!! str_limit($result->description, 80) !!}</td>
      <td>{{ $result->presentPrice() }}</td>
      </tr>
    @endforeach 
  </table>
  {{ $results->appends(request()->input())->links() }}
</div>


@endsection


