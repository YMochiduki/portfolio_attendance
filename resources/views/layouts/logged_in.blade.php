@extends('layouts.default')
 
@section('header')
<header class="title bg-info">
      <h3>欠課・欠席記録システム</h3>
      <h4>{{ Auth::user()->name }}</h4>
      
</header>  

@endsection

@section('right_menu')
  <nav class="navbar navbar-expand-sm navbar-light navbar-light">
    <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
      <span>メニュー</span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="right-menu list-unstyled">
        <li class="nav-item">
          <a href="{{ route('attendance.index') }}" class="btn btn-info">欠課・欠席入力</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('attendance.create') }}" class="btn btn-info">欠課・欠席履歴</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('students.index') }}" class="btn btn-info">名簿操作</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('user.index') }}" class="btn btn-info">学校情報</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('explanation') }}" class="btn btn-info">使用方法</a>
        </li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
              <input class="btn btn-dark" type="submit" value="ログアウト">
          </form>
        </li>
      </ul>
    </div>
  </nav>
@endsection