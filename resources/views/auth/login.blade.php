@extends('layouts.not_logged_in')

@section('content')
    <dl class="row">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label class="col-10">
                <dh>
                    メールアドレス
                </dh>
                <dt>
                    <input type="email" name="email" value="{{ old('email') }}">
                </dt>
            </label>
            <label class="col-10">
                <dh>
                パスワード
                </dh>
                <dt>
                <input type="password" name="password" value="{{ old('password') }}">
                </dt>
            </label>
            <input class="btn btn-info" type="submit" value="ログイン">
        </form>
    </dl>
    <ul>
        <li>動作確認用アカウント</li>
        <li>メールアドレス：testuser@gmail.com</li>
        <li>パスワード：hogehoge</li>
    </ul>
@endsection