<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // AuthenticatesUsersをオーバーライドする
    /**
     * Show the application's login form
     * 
     * @return \Illuminate\Http\Response
     */

    public function showLoginForm()
    {
      session()->put('previousUrl', url()->previous()); //セッションにログイン画面に遷移する前のURLを取得し、previousUrlと言う名前で保存する
      return view('auth.login');

    }

    public function redirectTo()
    {
      // loginするとこのメソッドが呼ばれる
      // previousUrlのURLを取得確認
      // dd(session()->get('previousUrl')); 
      return str_replace(url('/'), '' , session()->get('previousUrl', '/'));  //previousUrlがあればURLへ、なければトップページへリダイレクト
    }
}
