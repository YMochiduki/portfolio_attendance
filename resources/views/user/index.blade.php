@extends('layouts.logged_in')
@section('content')

<h3>登録情報</h3>

<dl class="row school-dada">
    <dt class="col-sm-6 col-10">学校名</dt>
    <dd class="col-sm-6 col-10">{{$user->name}}</dd>
    <dt class="col-sm-6 col-10">メールアドレス</dt>
    <dd class="col-sm-6 col-10">{{$user->email}}</dd>
    <dt class="col-sm-6 col-10">学年数</dt>
    <dd class="col-sm-6 col-10">{{$user->curriculum_year}}学年</dd>
    <dt class="col-sm-6 col-10">クラス数（１学年あたり最大数）</dt>
    <dd class="col-sm-6 col-10">{{$user->class_count}}クラス</dd>
</dl>

<button class="btn btn-info" data-toggle="modal" data-target="#modal">編集</button>
    
<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                    <button class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('user.update') }}">
                    @csrf
                    @method('patch')
                    <dl>
                        <label>
                            <dt>学校名</dt>
                            <dd>
                                <input type="text" name="name" value="{{ $user->name }}" placeholder="〇〇〇学校">
                            </dd>
                        </label>
                        <label>
                            <dt>メールアドレス</dt>
                            <dd>
                                <input type="email" name="email" value="{{ $user->email }}">
                            </dd>
                        </label>
                        <label>
                            <dt>学年数</dt>
                            <dd>
                                <input type="number" name="curriculum_year" value="{{ $user->curriculum_year }}">
                            </dd>
                        </label>
                        <label>
                            <dt>クラス数（１学年あたり最大数）</dt>
                            <dd>
                                <input type="number" name="class_count" value="{{ $user->class_count }}">
                            </dd>
                        </label>
           
                    </dl>
                        <input class="btn btn-info" type="submit" value="編集">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection