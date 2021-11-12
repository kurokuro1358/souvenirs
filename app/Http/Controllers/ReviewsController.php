<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Souvenir;
use App\Review;

class ReviewsController extends Controller
{
    public function store(Request $request)
    {
        // ログインしているかどうかのチェック
        if(Auth::check()){
            // バリデーション
            $request->validate([
                'souvenir_id' => 'required|integer',
                'comment' => 'required|max:16300'
            ]);
            
            // ログインユーザを取得
            $user = \Auth::user();
            // お土産を検索
            $souvenir = Souvenir::findOrFail($request->souvenir_id);
    
            // レビュー情報を保存
            Review::create([
                'user_id' => $user->id,
                'user_email' => $user->email,
                'souvenir_id' => $souvenir->id,
                'comment' => $request->comment
            ]);
            
            // 前のページへ遷移
            return back();
        } else{
            // ログインしていなければ、前のページに遷移
            return view('welcome')
        }
    }
    
    public function show()
    {
        //
    }
}
