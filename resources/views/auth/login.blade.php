@extends('layouts.not_logged_in')

@section('content')
    <h1>ログイン</h1>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label>
                メールアドレス：
                <input type="email" name="email" value="{{ old('email') }}">
            </label>
        </div>
        
        <div>
            <label>
                パスワード：
                <input type="password" name="password" value="{{ old('password') }}">
            </label>
        </div>

        <div>
            <input class="btn btn-outline-primary" type="submit" value="ログイン">
        </div>
    </form>
    <ul>
        <li>動作確認用アカウント</li>
        <li>メールアドレス：testuser@gmail.com</li>
        <li>パスワード：hogehoge</li>
    </ul>
@endsection