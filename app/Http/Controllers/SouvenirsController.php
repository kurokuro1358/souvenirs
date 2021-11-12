<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Image;
use App\Souvenir;
use App\User;
use App\Review;
use Illuminate\Support\Facades\Storage;

class SouvenirsController extends Controller
{
    // カテゴリー
    public $categories = ['お菓子' => 'お菓子', '食品' => '食品', '飲料品' => '飲料品', 'ビューティー・コスメ' => 'ビューティー・コスメ', 'ファッション' => 'ファッション', 'ジュエリー・アクセサリー' => 'ジュエリー・アクセサリー', '雑貨・ホビー' => '雑貨・ホビー', 'ホームキッチン' => 'ホームキッチン', '文房具' => '文房具', 'その他' => 'その他'];
        
    // 都道府県
    public $prefectures = ['北海道' => '北海道', '青森県' => '青森県', '岩手県' => '岩手県', '宮城県' => '宮城県', '秋田県' => '秋田県', '山形県' => '山形県', '福島県' => '福島県', '茨城県' => '茨城県', '栃木県' => '栃木県', '群馬県' => '群馬県', '埼玉県' => '埼玉県', '千葉県' => '千葉県', '東京都' => '東京都', '神奈川県' => '神奈川県', '新潟県' => '新潟県', '富山県' => '富山県', '石川県' => '石川県', '福井県' => '福井県', '山梨県' => '山梨県', '長野県' => '長野県', '岐阜県' => '岐阜県', '静岡県' => '静岡県', '愛知県' => '愛知県', '三重県' => '三重県', '滋賀県' => '滋賀県', '京都府' => '京都府', '大阪府' => '大阪府', '兵庫県' => '兵庫県', '奈良県' => '奈良県', '和歌山県' => '和歌山県', '鳥取県' => '鳥取県', '島根県' => '島根県', '岡山県' => '岡山県', '広島県' => '広島県', '山口県' => '山口県', '徳島県' => '徳島県', '香川県' => '香川県', '愛媛県' => '愛媛県', '高知県' => '高知県', '福岡県' => '福岡県', '佐賀県' => '佐賀県', '長崎県' => '長崎県', '熊本県' => '熊本県', '大分県' => '大分県', '宮崎県' => '宮崎県', '鹿児島県' => '鹿児島県', '沖縄県' => '沖縄県'];
        
    public function index($prefecture)
    {
        // 渡された都道府県が間違った値だったら、元のページへリダイレクト
        if(!in_array($prefecture, $this->prefectures)){
            return back();
        }
        
        // 対象の都道府県のお土産を取得
        $souvenirs = Souvenir::where('prefecture', $prefecture)->paginate(12);
            
        // 対象のお土産の画像を取得
        $images = array();
        foreach($souvenirs as $souvenir){
            $images[] = $souvenir->images()->get();
        }

        // 一覧ビューに表示
        return view('souvenirs.index', [
            'prefecture' => $prefecture,
            'souvenirs' => $souvenirs,
            'images' => $images,
            'categories' => $this->categories
        ]);
    }
    
    public function show($id)
    {
        // idからお土産を検索
        $souvenir = Souvenir::findOrFail($id);
        // お土産から画像を検索
        $images = $souvenir->images()->get();
        // お土産から登録したユーザを検索
        $user = User::findOrFail($souvenir->user_id);
        // お土産からレビューを検索
        $reviews = $souvenir->reviews()->get();

        // お土産詳細ビューに表示
        return view('souvenirs.show', [
            'souvenir' => $souvenir,
            'images' => $images,
            'user' => $user,
            'reviews' => $reviews
        ]);
    }
    
    public function create()
    {
        // 新しいお土産を作成
        $souvenir = new Souvenir;
        
        // お土産詳細ビューに表示
        return view('souvenirs.create', [
            'souvenir' => $souvenir, 
            'categories' => $this->categories,
            'prefectures' => $this->prefectures
        ]);
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'file' => 'max:5',
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'category' => 'required',
            'prefecture' => 'required',
            'description' => 'required|max:16300',
            'url' => 'required_without:address|max:16300',
            'address' => 'max:16300'
        ]);
        
        // 入力された画像情報を取得
        $files = $request->file('file');

        // 画像の保存
        foreach($files as $file){
            // 画像の名前を取得
        	$file_name = $file->getClientOriginalName();
        	// public下に画像を保存
        	$file->storeAS('public',$file_name);
        }
        
        // お土産情報の保存
        $user = \Auth::user();
        $souvenir = $user->souvenirs()->create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'prefecture' => $request->prefecture,
            'description' => $request->description,
            'url' => $request->url,
            'address' => $request->address
        ]);
        
        // 画像情報の保存
        $images = array();
        foreach($files as $file){
            $images[] = $souvenir->images()->create([
                'path' => $file->getClientOriginalName()
            ]);
        }
        
        // 詳細ビューに遷移
        return $this->show($souvenir->id);
    }
    
    public function edit($id)
    {
        // idからお土産を検索
        $souvenir = Souvenir::findOrFail($id);
        // お土産がユーザが登録したものかチェック
        if(\Auth::user()->id == $souvenir->user_id){
            // お土産から画像を検索
            $images = $souvenir->images()->get();
            
            // お土産詳細ビューに表示
            return view('souvenirs.edit', [
                'souvenir' => $souvenir, 
                'images' => $images,
                'categories' => $this->categories,
                'prefectures' => $this->prefectures
            ]); 
        } else{
            // お土産がユーザが登録したものではない時の処理
            // 前のページに遷移
            return $this->registered();
        }
    }
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'category' => 'required',
            'prefecture' => 'required',
            'description' => 'required|max:16300',
            'url' => 'required_without:address|max:16300',
            'address' => 'max:16300'
        ]);
        
        // 画像の変更があれば変更をする
        if(!is_null($request->file('file'))){
            // 前の画像を削除
            // idからお土産を検索
            $souvenir = Souvenir::findOrFail($id);
            // お土産から画像を検索
            $images = $souvenir->images()->get();
            // 1枚ずつ画像を削除
            foreach($images as $image){
                // deleted_atに日時を記録
                $image->delete();
            }
            
            // 新しい画像の保存
            $files = $request->file('file');
            foreach($files as $file){
            	$file_name = $file->getClientOriginalName();
            	$file->storeAS('public',$file_name);
            	$souvenir->images()->create([
                    'path' => $file_name
                ]);
            }
        }
        
        // お土産情報の保存
        $souvenir = Souvenir::findOrFail($id);
        $souvenir->update([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'prefecture' => $request->prefecture,
            'description' => $request->description,
            'url' => $request->url,
            'address' => $request->address
        ]);
        
        // 詳細ビューに遷移
        return $this->registered_show($id);
    }
    
    public function delete($id)
    {
        // idからお土産を検索
        $souvenir = Souvenir::findOrFail($id);
        // お土産から画像を検索
        $images = $souvenir->images()->get();
        
        // お土産のdeleted_atに日時を記録
        $souvenir->delete();
        // 画像のdeleted_atに日時を記録
        $images->delete();
        
        // 登録したお土産一覧に遷移
        return $this->registered();
    }
    
    public function registered()
    {
        // ログインユーザを取得
        $user = \Auth::user();
        // ユーザからお土産を検索
        $souvenirs = $user->souvenirs()->paginate(12);
        
        // お土産から画像を取得
        $images = array();
        foreach($souvenirs as $souvenir){
            $images[] = $souvenir->images()->get();
        }
        
        // 一覧ビューに表示
        return view('souvenirs.registered', [
            'souvenirs' => $souvenirs,
            'images' => $images
        ]);
    }
    
    public function registered_show($id)
    {
        // idからお土産を検索
        $souvenir = Souvenir::findOrFail($id);
        // お土産がユーザが登録したものかチェック
        if(\Auth::user()->id == $souvenir->user_id){
            $images = $souvenir->images()->get();

            // お土産詳細ビューに表示
            return view('souvenirs.registered_show', [
                'souvenir' => $souvenir,
                'images' => $images,
            ]);
        } else{
            // お土産がユーザが登録したものでなければ前のページに遷移
            return $this->registerd();
        }
    }
    
    public function search(Request $request)
    {
        // 都道府県とカテゴリーから対象となるお土産を検索
        $souvenirs = Souvenir::where('prefecture', $request->prefecture)->where('category', $request->category)->paginate(12);
        // お土産から画像を検索
        $images = array();
        foreach($souvenirs as $souvenir){
            $images[] = $souvenir->images()->get();
        }
        
        // 一覧ビューに表示
        return view('souvenirs.index', [
            'prefecture' => $request->prefecture,
            'souvenirs' => $souvenirs,
            'images' => $images,
            'categories' => $this->categories
        ]);
    }
}
