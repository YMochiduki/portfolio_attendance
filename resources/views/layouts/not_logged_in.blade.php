@extends('layouts.default')
 
@section('header')
<header>
    <h3 class="title bg-info">学校用欠課・欠席記録システム</h3>
    <nav class="nav nav-tabs">
    @auth
        <a href="{{ route('attendance.index') }}"  class="nav-link btn btn-dark">
            トップへ戻る
        </a>
    @else
        <a href="{{ route('explanation') }}"  class="nav-link btn btn-dark">
            使用方法
        </a>
        <a href="{{ route('register') }}" class="nav-link btn btn-dark">
            新規登録
        </a>
        <a href="{{ route('login') }}"  class="nav-link btn btn-dark">
            ログイン
        </a>
    @endauth
    </nav>
</header>
@endsection