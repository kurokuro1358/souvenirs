@extends('layouts.app')

@section('content')

    <h4 class="mb-5">登録したお土産</h4>
    @if(sizeof($souvenirs) == 0)
        {{-- お土産が登録されていない時の処理 --}}
        <div class="text-center">お土産は登録されていません</div>
        {{ link_to_route('souvenirs.create', 'お土産を登録する', [], ['class' => 'btn btn-success']) }}
    @else
        <div class="row">
            @foreach($souvenirs as $index => $souvenir)
                <div class="col-md-4 col-6 index_souvenir">
                    <div class="d-flex align-items-center">
                        {{-- サムネイル画像 --}}
                        <img class="img-fluid" src="{{ $images[$index][0]->path }}">
                    </div>
                    <div class="pb-2">
                        {{-- お気に入りフォーム --}}
                        @if(Auth::check())
                            <div class="heart text-right">
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
                            </div>
                        @endif
                        
                        {{-- 商品名 --}}
                        <div><b>{{ $souvenir->name  }}</b></div>
                        {{-- 参考価格 --}}
                        <div><b>{{ $souvenir->price }}円（参考価格）</b></div>
                    </div>
                    
                    {{-- 詳細ビューへのリンク --}}
                    <a href="{{ route('souvenirs.registered_show', ['souvenir' => $souvenir->id])}}"></a>
                </div>
            @endforeach
        </div>
        
        {{-- ページネーション--}}
        <div class="d-flex justify-content-center">{{ $souvenirs->links() }}</div>
    @endif

@endsection