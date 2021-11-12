@extends('layouts.app')

@section('content')

    <h4 class="text-center">お土産登録</h4>
    <div class="w-100">
        {{-- 入力された画像を表示する --}}
        <div id="show_images"></div>
        
        {{-- お土産登録フォーム--}}
        {!! Form::open(['route' => 'souvenirs.store', 'files' => true] ) !!}
            
            <div class="form-group">
                {!! Form::label('selected_images', '画像を追加する', ['class' => 'btn btn-outline-primary', 'id' => 'selected_images_label']) !!}
                {!! Form::file('images', ['id' => 'selected_images', 'class' => 'd-none', 'multiple', 'name' => 'file[]']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('name', '商品名') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('price', '参考価格') !!}
                {!! Form::number('price', null, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('category', 'カテゴリー') !!}
                {!! Form::select('category', $categories, null, ['class' => 'form-control', 'placeholder' => '選択してください']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('prefecture', '都道府県') !!}
                {!! Form::select('prefecture', $prefectures, null, ['class' => 'form-control', 'placeholder' => '選択してください']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('description', '説明') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('url', 'サイトURL') !!}
                {!! Form::text('url', null, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('address', '買える場所') !!}
                {!! Form::text('address', null, ['class' => 'form-control']) !!}
            </div>


            {!! Form::submit('登録', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
    </div>

@endsection