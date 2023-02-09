@extends('layout')

{{-- タイトル --}}
@section('title')@endsection

{{-- メインコンテンツ --}}
@section('contets')
        <h1>会員登録</h1>

            @if ($errors->any())
                <div>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
                </div>
            @endif
            <form action="/user/register" method="post">
                @csrf
                名前:<input name="name" value="{{ old('name') }}"><br>
                メール:<input name="email" value="{{ old('email') }}"><br>
                パスワード:<input name="password" type="password"><br>
                パスワード（再度）: <input type="password" name="password_confirmation"><br>
                <button>登録する</button>
            </form>
        <br>
@endsection