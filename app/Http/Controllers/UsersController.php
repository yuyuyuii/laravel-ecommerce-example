<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
      // $user = User::where('id', $id)->first();
      // return view('edit')->with([
      //   'user' => $user
      // ]);
      return view('edit')->with([
        'user' => auth()->user(), //これだけでログインしているユーザー情報が取得できて、viewに渡せる
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(), //,email,'.auth()->id()を追記しないとunique制約を突破できない、現在のユーザーIDと同じだったらOkみたいな感じか
            'password' => 'sometimes|nullable|string|min:6|confirmed', //sometimesは入力があればvalidationを適用するらしい、nullも許可している
        ]);
          //現在のユーザー情報を取得し、変数へ入れる
          //入力情報を取得
        $user = auth()->user();
        $input = $request->except('password', 'password_confirmation'); //exceptは入力の一部を取得するメソッド、password, password_confirmation以外を取得する
        if(! $request->filled('password')){ //passwordが空だったらname, emailを保存し、passwordは更新しない
          $user->fill($input)->save();
          return back()->with('success_message', 'プロフィールを更新しました'); 
        }
        //passwordが入力されていたら入力された値でユーザー情報を更新する
        //passwordを暗号化する
        $user->password = bcrypt($request->password);
        $user->fill($input)->save();

        return back()->with('success_message', 'プロフィールとパスワードを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
