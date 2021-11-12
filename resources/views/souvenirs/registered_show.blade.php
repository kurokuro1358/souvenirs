@extends('layouts.app')

@section('content')

    <div class="d-flex mb-5">
        {{-- 登録したお土産一覧へのリンクとお土産名の表示 --}}
        <div class="mr-auto">{{ link_to_route('souvenirs.registered', '登録したお土産一覧') }} > {{ $souvenir->name }}</div>
            <div>
                {{-- メッセージ削除フォーム --}}
                <div class="d-flex">
                    {{-- 削除のモーダル画面 --}}
                    <div class="btn btn-danger mr-1" data-toggle="modal" data-target="#delete">
                        削除
                    </div>
                    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    本当に削除しますか？
                                </div>
                                <div class="modal-footer">
                                    {{-- 削除をキャンセルするボタン --}}
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                    {{-- 削除するボタン --}}
                                    <div>
                                        {!! Form::model($souvenir, ['route' => ['souvenirs.destroy', $souvenir->id], 'method' => 'delete']) !!}
                                            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- 編集ページへのリンク--}}
                    <div>
                        {!! link_to_route('souvenirs.edit', '編集', ['souvenir' => $souvenir->id], ['class' => 'btn btn-outline-primary']) !!}
                    </div>
                </div>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-12 col-md-6" id="show_souvenir_images">
            {{-- サムネイル画像を大きく表示する --}}
            <div id="show_thumb_image" class="mb-1"><img class="img-fluid" src="/storage/{{ $images[0]->path }}"></div>
            {{-- すべての画像を表示する --}}
            <div class="d-flex justify-content-start">
                @foreach($images as $image)
                    <img class="img-fluid" src="/storage/{{ $image->path }}">
                @endforeach
            </div>
        </div> 
        
        <div class="col-12 col-md-6">
            <div class="text-right heart">
                @if(Auth::check())
                    @if(Auth::user()->is_favorite($souvenir->id))
                        {{-- お気に入りを外す --}}
                        {!! Form::open(['route' => ['favorites.unfavorite', $souvenir->id], 'method' => 'delete']) !!}
                            {!! Form::submit('&hearts;', ['class' => 'text-danger']) !!}
                        {!! Form::close() !!}
                    @else
                        {{-- お気に入りにする --}}
                        {!! Form::open(['route' => ['favorites.favorite', $souvenir->id]]) !!}
                            {!! Form::submit('&#9825;', ['class' => 'text-muted']) !!}
                        {!! Form::close() !!}
                    @endif
                @endif
            </div>
            {{-- 商品名 --}}
            <h3 class="my-2">{!! nl2br($souvenir->name) !!}</h3>
            {{-- 参考価格 --}}
            <div class="my-2 ml-5">{!! nl2br($souvenir->price) !!}円（参考価格）</div>
            {{-- 買えるサイトへのリンク --}}
            <a class="my-2 btn btn-success w-50 text-white" href="{{ $souvenir->url }}">サイトへ<i class="fas fa-angle-double-right ml-2"></i></a>
            {{-- 買える場所 --}}
            <div class="my-2"><i class="fas fa-map-marker-alt mr-2 text-danger"></i>{!! nl2br($souvenir->address) !!}</div>
            {{-- 説明 --}}
            <div class="mt-5">{!! nl2br($souvenir->description) !!}</div>
        </div>
    </div>
@endsection