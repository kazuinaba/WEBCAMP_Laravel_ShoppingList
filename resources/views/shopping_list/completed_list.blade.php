@extends('layout')

{{-- タイトル --}}
@section('title')@endsection

{{-- メインコンテンツ --}}
        <h1>購入済み「買うもの」一覧</h1>
        <a href="/shopping_list/list">「買うもの」一覧に戻る</a>
        <table border="1">
        <tr>
            <th>「買うもの」名
            <th>購入日
            
@foreach ($completed_shopping_list as $task)
        <tr>
            <td>{{ $task->name }}
            <td>{{ $task->created_at->format('Y/m/d') }}
            
@endforeach
        </table>
        
        <!-- ページネーション -->

 現在 {{ $completed_shopping_list->currentPage() }} ページ目<br>
 
         @if ($completed_shopping_list->onFirstPage() === false)
        <a href="/completed_shopping_list/list">最初のページ</a>
        @else
        最初のページ
        @endif
        /
        @if ($completed_shopping_list->previousPageUrl() !== null)
            <a href="{{ $completed_shopping_list->previousPageUrl() }}">前に戻る</a>
        @else
            前に戻る
        @endif
        /
        @if ($completed_shopping_list->nextPageUrl() !== null)
            <a href="{{ $completed_shopping_list->nextPageUrl() }}">次に進む</a>
        @else
            次に進む
        @endif
        <br>
        <hr>
        <menu label="リンク">
        <a href="/logout">ログアウト</a><br>
        </menu>