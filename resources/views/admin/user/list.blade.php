@extends('admin.layout')

{{-- メインコンテンツ --}}
@section('contets')
@auth('admin')
        <menu label="リンク">
        <a href="/admin/top">管理画面TOP</a><br>
        <a href="/admin/user/list">ユーザ一覧</a><br>
        <a href="/admin/logout">ログアウト</a><br>
        </menu>
@endauth
        <h1>ユーザ一覧</h1>
        <table border="1">
        <tr>
            <th>ユーザID
            <th>ユーザ名
            <th>購入した「買うもの」の数
@foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}
            <td>{{ $user->name }}
            <td>{{ $user->task_num }}
@endforeach
        </table>
@endsection