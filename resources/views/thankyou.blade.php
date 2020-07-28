@extends('layout')

@section('title', 'Thank You')

@section('extra-css')

@endsection

@section('body-class', 'sticky-footer')

@section('content')

   <div class="thank-you-section">
      @if(session()->has('success_message'))
        <div class="spacer"></div>
        <div class="alert alert-success">
          {{ session()->get('success_message') }}
        </div>
      @endif

      @if( count($errors) > 0 )
        <div class="spacer"></div>
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)          
            <li>
              {{ $error }}
            </li>
            @endforeach
          </ul>
        </div>
      @endif
       <h1>Thank you for <br> Your Order!</h1>
       <p>A confirmation email was sent</p>
       <div class="spacer"></div>
       <div>
           <a href="{{ url('/') }}" class="button">Home Page</a>
       </div>
   </div>




@endsection
