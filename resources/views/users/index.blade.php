@extends('layouts.app')

@section('content')
    <div class="text-right">
        {!!  link_to_route('favorites.index', 'お気に入り一覧', [], ['class' => 'btn btn-success']) !!}
        {!!  link_to_route('souvenirs.registered', '登録したお土産一覧', [], ['class' => 'btn btn-info']) !!}
    </div>

    <div class="row show_user border rounded border-primary">
        <div class="col-6 text-center">
            {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
            <img class="rounded-circle" src="{{ Gravatar::get(Auth::user()->email, ['size' => 150]) }}" alt="">
        </div>
        <div class="col-6">
            <div class="label">お名前</div>
            <div class="label_content">{{ $user->name }}</div>
            <div class="label">メールアドレス</div>
            <div class="label_content">{{ $user->email }}</div>
            {{ link_to_route('users.edit', '編集', ['user' => $user->id], ['class' => 'btn btn-primary mt-2 w-25']) }}
        </div>
    </div>
    
@endsection