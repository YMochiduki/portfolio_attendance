<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!--bootstrap4の読み込み-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="row">
    <header class="offset-1 col-10">
            @yield('header')
            {{-- エラーメッセージを出力 --}}
            @if($errors->all() !== [])
                <div class="error">
                <p>【Attention】<br>フォームの送信内容に不備があります。入力内容は保存されていません。<br>入力内容を確認してください。</p>
                <ul>
                    @foreach($errors->all() as $error)
                            <li class="error-detail">{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
            @endif
            {{-- 成功メッセージを出力 --}}
            @if (session()->has('success'))
                <div class="success">
                    {{ session()->get('success') }}
                </div>
            @endif
    </header>
</div>

    <div class="row offset-1">
        <div class="col-sm-9 col-10  order-2 order-sm-1">
            @yield('content')
        </div>
        <div class="col-sm-2 col-10 order-1 order-sm-2 right_menu">
            @yield('right_menu')
        </div>
    </div>

</body>
</html>