<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Image;

class FavoritesController extends Controller
{
    public function index()
    {
        // ログインユーザからお気に入りのお土産を検索
        $souvenirs = \Auth::user()->favorites()->paginate(12);
        
        // お土産から画像を検索
        $images = array();
        foreach($souvenirs as $souvenir){
            $images[] = $souvenir->images()->get();
        }
       
        // お気に入り一覧ビューで表示 
        return view('favorites.index', [
            'souvenirs' => $souvenirs,
            'images' => $images
        ]);
    }
    
    public function store($id)
    {
        // idで渡されたお土産をログインユーザのお気に入りにする
        \Auth::user()->favorite($id);
        
        // 前のリンクへ遷移
        return back();
    }
    
    public function destroy($id)
    {
        // idで渡されたお土産をログインユーザのお気に入りから外す
        \Auth::user()->unfavorite($id);
        
        // 前のリンクへ遷移
        return back();
    }
}
