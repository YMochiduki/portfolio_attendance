@extends('layouts.logged_in')
@section('content')

    <h3>登録情報</h3>
    <dl class="row">
        <dt class="col-sm-5 col-10">学校名</dt>
        <dd class="col-sm-5 col-10col-5">{{$user->name}}</dd>
        <dt class="col-sm-5 col-10">メールアドレス</dt>
        <dd class="col-sm-5 col-10">{{$user->email}}</dd>
        <dt class="col-sm-5 col-10">学年数</dt>
        <dd class="col-sm-5 col-10">{{$user->curriculum_year}}学年</dd>
        <dt class="col-sm-5 col-10">クラス数（１学年あたり最大数）</dt>
        <dd class="col-sm-5 col-10">{{$user->class_count}}クラス</dd>
    </dl>
    
    <button class="btn btn-info" data-toggle="modal" data-target="#modal">編集</button>
    
    <div class="modal fade" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                        <button class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                <div class="modal-body">
                    <form method="POST" action="{{ route('user.update') }}">
                        @csrf
                        @method('patch')
                        <div>
                            <label>
                            学校名：
                                <input type="text" name="name" value="{{ $user->name }}" placeholder="〇〇〇学校">
                            </label>
                        </div>
                        <div>
                            <label>
                                メールアドレス：
                            <input type="email" name="email" value="{{ $user->email }}">
                            </label>
                        </div>
                        <div>
                            <label>
                                学年数：
                                <input type="number" name="curriculum_year" value="{{ $user->curriculum_year }}">
                            </label>
                        </div>
                        <div>
                            <label>
                                クラス数（１学年あたり最大数）：
                                <input type="number" name="class_count" value="{{ $user->class_count }}">
                            </label>
                        </div>                
                            <input class="btn btn-info" type="submit" value="編集">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection