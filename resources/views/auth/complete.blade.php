@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>会員登録が完了しました！</h1>
    </div>

    <div class="row show_user border border-success rounded">
        <div class="col-6 text-center">
            {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
            <img class="rounded-circle" src="{{ Gravatar::get(Auth::user()->email, ['size' => 150]) }}" alt="">
        </div>
        <div class="col-6">
            <div class="label">お名前</div>
            <div class="label_content">{{ Auth::user()->name }}</div>
            <div class="label">メールアドレス</div>
            <div class="label_content">{{ Auth::user()->email }}</div>
        </div>
    </div>
    
@endsection