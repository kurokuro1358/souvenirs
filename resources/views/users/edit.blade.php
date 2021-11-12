@extends('layouts.app')

@section('content')

    <div class="text-right">
        {{ link_to_route('users.index', '戻る', [], ['class' => 'btn btn-light']) }}
    </div>

    {!! Form::open(['route' => ['users.update', $user->id], 'method' => 'put']) !!}
        <div class="form-group">
            {!! Form::label('name', '名前') !!}
            {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'メールアドレス') !!}
            {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('更新', ['class' => 'btn btn-primary btn-block']) !!}
    {!! Form::close() !!}
    
@endsection