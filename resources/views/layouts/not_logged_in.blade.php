@extends('layouts.default')
 
@section('header')
<header>
    <ul class="header_nav" class="list-inline">
        <li class="list-inline-item">
            <a href="{{ route('register') }}">
                ユーザー登録
            </a>
        </li>
        <li class="list-inline-item">
            <a href="{{ route('login') }}">
                ログイン
            </a>
        </li>
    </ul>
</header>
@endsection