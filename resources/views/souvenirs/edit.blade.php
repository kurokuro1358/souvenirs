@extends('layouts.app')

@section('content')

    <div class="w-100">
        <div id="show_images">
            @foreach($images as $image)
                <img class="img-fluid mb-2 w-25" src="/storage/{{ $image->path }}">
            @endforeach
        </div>
        {!! Form::open(['route' => ['souvenirs.update', 'souvenir' => $souvenir->id], 'method' => 'put', 'files' => true] ) !!}
            
            <div class="form-group">
                {!! Form::label('selected_images', '画像を変更する', ['class' => 'btn btn-outline-primary', 'id' => 'selected_images_label']) !!}
                {!! Form::file('images', ['id' => 'selected_images', 'class' => 'd-none', 'multiple', 'name' => 'file[]']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('name', '商品名') !!}
                {!! Form::text('name', $souvenir->name, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('price', '参考価格') !!}
                {!! Form::number('price', $souvenir->price, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('category', 'カテゴリー') !!}
                {!! Form::select('category', $categories, $souvenir->category, ['class' => 'form-control', 'placeholder' => '選択してください']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('prefecture', '都道府県') !!}
                {!! Form::select('prefecture', $prefectures, $souvenir->prefecture, ['class' => 'form-control', 'placeholder' => '選択してください']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('description', '説明') !!}
                {!! Form::textarea('description', $souvenir->description, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('url', 'サイトURL') !!}
                {!! Form::text('url', $souvenir->url, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('address', '買える場所') !!}
                {!! Form::text('address', $souvenir->address, ['class' => 'form-control']) !!}
            </div>


            {!! Form::submit('変更', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}

    </div>

@endsection