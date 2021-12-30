@extends('layouts.default')
 
@section('header')
    <h2 class="list-inline-item">{{ Auth::user()->name }}</h2>
    <form action="{{ route('logout') }}" method="POST">
    @csrf
      <input class="btn btn-info float-right" type="submit" value="ログアウト">
    </form>
@endsection

@section('right_menu')
<div>
  <nav class="navbar-expand-sm navbar-light">
    <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
      <span>メニュー</span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul>
        <li><a href={{ route('attendance.index') }}>欠課・欠席入力</a></li>
        <li>欠課・欠席履歴</li>
        <li>名簿操作</li>
      </ul>
    </div>
  </nav>
</div>

@endsection