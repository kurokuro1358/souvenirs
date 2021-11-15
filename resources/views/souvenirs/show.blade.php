@extends('layouts.app')

@section('content')

    {{-- お土産が属する都道府県とお土産名の表示 --}}
    <div class="mb-5">{{ link_to_route('souvenirs.index', $souvenir->prefecture, ['prefecture' => $souvenir->prefecture]) }} > {{ $souvenir->name }}</div>
    
    {{-- お土産を登録したユーザ --}}
    <div>
        <img class="rounded-circle img-fluid" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
        <span class="ml-2">{{ $user->name }}</span>
    </div>
    
    <div class="row mb-3">
        {{-- お土産の画像 --}}
        <div class="col-12 col-md-6" id="show_souvenir_images">
            {{-- サムネイル画像を表示する--}}
            <div id="show_thumb_image" class="mb-1"><img class="img-fluid" src="{{ $images[0]->path }}"></div>
            {{-- すべての画像を表示する --}}
            <div class="d-flex justify-content-start">
                @foreach($images as $image)
                    <img class="img-fluid" src="{{ $image->path }}">
                @endforeach
            </div>
        </div> 
        
        {{-- お土産の詳細 --}}
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
            {{-- 買えるサイトのリンク--}}
            <a class="my-2 btn btn-success w-50 text-white" href="{{ $souvenir->url }}">サイトへ<i class="fas fa-angle-double-right ml-2"></i></a>
            {{-- 買える場所 --}}
            <div class="my-2"><i class="fas fa-map-marker-alt mr-2 text-danger"></i>{!! nl2br($souvenir->address) !!}</div>
            {{-- 説明 --}}
            <div class="mt-5">{!! nl2br($souvenir->description) !!}</div>
        </div>
    </div>
    
    @if(Auth::check())
        {{-- レビューフォーム --}}
        <div id="review_form" class="mt-5">
            {!! Form::open(['route' => 'review.store']) !!}
                <div class="row">
                    <div class="col-10 form-group">{!! Form::text('comment', null, ['class' => 'form-control']) !!}</div>
                    {{ Form::hidden('souvenir_id', $souvenir->id) }}
                    <div class="col-2">{!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}</div>
                </div>
            {!! Form::close() !!}
        </div>
    @else
        {{-- ログインしていない場合は、レビューをできなくして、ログインを促す--}}
        <div id="review_form disable_review_form" class="mt-5">
            {!! Form::open(['route' => 'review.store']) !!}
                <div class="row">
                    <div class="col-10 form-group">{!! Form::text('comment', '', ['class' => 'form-control', 'readonly']) !!}</div>
                    {{ Form::hidden('souvenir_id', $souvenir->id) }}
                    <div class="col-2">{!! Form::submit('投稿', ['class' => 'btn btn-primary', 'disabled']) !!}</div>
                </div>
            {!! Form::close() !!}
            <div class="mb-2">{{ link_to_route('login', 'ログインしてレビューを書く') }}</div>
        </div>
    @endif
        {{-- レビューの一覧表示 --}}
        <div>
            @foreach($reviews as $review)
                <div class="d-flex align-items-center mb-2">
                    <div class="mr-2">
                        <div><img class="rounded-circle img-fluid" src="{{ Gravatar::get($user->email, ['size' => 40]) }}" alt=""></div>
                        <div class="reviewer text-center">{{ $user->name }}</div>
                    </div>
                    <div>
                        {{ $review->comment }}
                    </div>
                </div>
            @endforeach
        </div>
@endsection