<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rule;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        // 認証済みユーザを取得
        $user = Auth::user();
        
        // ビューに表示
        return view('users.index', [
            'user' => $user  
        ]);
    }
    
    public function edit($id)
    {
        // idでユーザを検索
        $user = User::findOrFail($id);
        // ログインユーザと一致するか検証
        if($user->id == \Auth::user()->id){
            // 編集ビューで表示
            return view('users.edit', [
                'user' => $user
            ]);
        } else{
            return $this->index();
        }
        
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', Rule::unique('users')->ignore($id)]
        ]);
        // idでユーザを検索
        $user = User::findOrFail($id);
        
        // ユーザ詳細を更新
        $user->fill($request->all())->save();
        
        // ユーザ詳細ビューにリダイレクト
        return view('users.index', [
            'user' => $user
        ]);
    }
}
