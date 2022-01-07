@extends('layouts.not_logged_in')

@section('content')
    <h1>ユーザー登録</h1>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label>
                学校名：
                <input type="text" name="name" value="{{ old('name') }}" placeholder="〇〇〇学校">
            </label>
        </div>
        <div>
            <label>
                学年数：
                <input type="number" name="curriculum_year">
            </label>
        </div>
        <div>
            <label>
                クラス数（１学年あたり）：
                <input type="number" name="class_count">
            </label>
        </div>                
        <div>
            <label>
                メールアドレス：
                <input type="email" name="email" value="{{ old('email') }}">
            </label>
        </div>
        
        <div>
            <label>
                パスワード：
                <input type="password" name="password">
            </label>
        </div>
        
        <div>
            <label>
                パスワード（確認用）：
                <input type="password" name="password_confirmation">
            </label>
        </div>
        <div>
            <input class="btn btn-outline-primary" type="submit" value="登録">
        </div>
    </form>
@endsection