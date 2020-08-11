@extends('layout')

@section('title', 'my-profile')
@section('extra-css')

@endsection

@section('content') 

    <div class="breadcrumbs">
        <div class="container">
            <a href="/">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <a href="{{ route('user.edit')}}">My Profile</a>
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
    <div class="products-section container">

        <div class="sidebar">
          <ul>
            <li class="active"><a href="{{ route('user.edit') }}">My Profile</a></li>
            <li ><a href="{{ route('order.index') }}">注文履歴</a></li>
          </ul>
        </div> <!-- end sidebar -->

        <div>
          <div class="products-header">
            <h1 class="stylish-heading">My Profile</h1>
          </div>
          <div class="products text-center">
            <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('user.update', $user->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" placeholder='name' required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('name', $user->email) }}" placeholder='email' required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder='password' >
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder='password_confirmation' >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end products -->
        </div>
    
    </div>

@endsection
