@extends('layouts.not_logged_in')

@section('content')
<dl class="row">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
        <label>
            <dh>
                学校名
            </dh>
            <dd>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="〇〇〇学校">
            </dd>
        </label>

        <label>
            <dh>
                学年数
            </dh>
            <dd>
                <input type="number" name="curriculum_year" value="{{ old('curriculum_year') }}">
            </dd>
        </label>

        <label>
            <dh>
                クラス数（１学年あたり最大数）
            </dh>
            <dd>
                <input type="number" name="class_count" value="{{ old('class_count') }}">
            </dd>
        </label>
        </div>
        <div>
        <label>
            <dh>
                メールアドレス
            </dh>
            <dd>
                <input type="email" name="email" value="{{ old('email') }}">
            </dd>
        </label>

        <label>
            <dh>
                パスワード
            </dh>
            <dd>
                <input type="password" name="password">
            </dd>
        </label>

        <label>
            <dh>
                パスワード（確認用）
            </dh>
            <dd>
                <input type="password" name="password_confirmation">
            </dd>
        </label>
        </div>
        
        <input class="btn btn-info" type="submit" value="新規登録">
    </form>
</dl>
@endsection