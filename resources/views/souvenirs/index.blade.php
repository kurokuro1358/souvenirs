@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between">
        <h2 class="mb-5">{{ $prefecture }}</h2>
        <div>
            {{ Form::open(['route' => 'souvenirs.search', 'method' => 'get'])}}
                <div class="form-row">
                    {{ Form::hidden('prefecture', $prefecture) }}
                    <div class="col-9">{!! Form::select('category', $categories, null, ['class' => 'form-control', 'placeholder' => '---']) !!}</div>
                    <div class="col-3">{!! Form::submit('検索', ['class' => 'btn btn-primary btn-block']) !!}</div>
                </div>
            {{ Form::close()}}
        </div>
    </div>
    @if(sizeof($souvenirs) == 0)
        {{-- お土産が登録されていない時の表示 --}}
        <div class="text-center">お土産が登録されていません</div>
        {{ link_to_route('souvenirs.create', 'お土産を登録する', [], ['class' => 'btn btn-success']) }}
    @else
        <div class="row">
            @foreach($souvenirs as $index => $souvenir)
                <div class="col-md-4 col-6 index_souvenir">
                    
                    <div class="d-flex align-items-center">
                        {{-- 画像サムネイル --}}
                        <img class="img-fluid" src="{{ $images[0][$index]->path }}">
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
                    <a href="{{ route('souvenirs.show', ['souvenir' => $souvenir->id])}}"></a>
                </div>
            @endforeach
        </div>
        
        {{-- ページネーションのリンク --}}
        <div class="d-flex justify-content-center">{{ $souvenirs->links() }}</div>
    @endif

@endsection