@extends('layouts.students_list')
@section('search_form')

@php $curriculum_year = Auth::user()->curriculum_year @endphp
@php $class_count = Auth::user()->class_count @endphp

<p class="description-head">◆名簿追加</p>
<div class="list-edit">
<dl class="row">
    <dt class="col-sm-3 col-10">個別追加</dt>
    <dd class="col-sm-9 col-10">
        <button class="btn btn-info" data-toggle="modal" data-target="#modal">生徒新規登録</button>
        <div class="modal fade" id="modal">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p>生徒新規登録</p>
                    <button class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('students.store')}}">
                        @csrf
                        <label>
                            年度
                            <input type="number" name="year" class="form-year" value="{{ old('year') }}">
                        </label>
                        <label>
                            <select name="grade">
                                @for($i=1; $i <=$curriculum_year; $i++)
                                    <option value="{{ $i }}" @if(old('grade') === $i )selected @endif>{{ $i }}年</option>    
                                @endfor
                            </select>
                        </label>
                            <select name="class">
                                @for($i=1; $i <= $class_count; $i++)
                                    <option value="{{ $i }}" @if(old('class') === $i )selected @endif>{{ $i }}組</option>    
                                @endfor
                            </select>
                        <label>
                            出席番号
                            <input type="number" name="number" class="form-year" value="{{ old('number') }}">
                        </label>
                        <label>
                            名前
                            <input type="text" name="name" value="{{ old('name') }}">
                        </label>
                        <input class="btn btn-info" type="submit" value="追加">
                    </form>
                </div>
            </div>
        </div>
        </div>
    </dd>

    <dt class="col-sm-3 col-10">一括追加</dt>
    <dd class="col-sm-9 col-10">
        <form method="post" action="/students_import" enctype="multipart/form-data">
            @csrf
            <input class="excel" type="file" name="excel_file" ><br>
            <input class="btn btn-info" type="submit" value="エクセルからインポート">
        </form>
    </dd>

    <dt class="col-sm-3 col-10">一括追加用様式</dt>
    <dd class="col-sm-9 col-10">
        <form method="post" action="{{ route('students.ListStyleExport') }}">
            @csrf
            <input type="submit" value="名簿様式ダウンロード">
        </form>
    </dd>
</dl>

</div>
<p class="description-head">◆名簿削除</p>
<div class="text-right">
    <button class="btn btn-dark" data-toggle="modal" data-target="#modal-D-all">全ての生徒情報を削除</button>
</div>
<div class="modal fade" id="modal-D-all">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>全ての生徒情報を削除を実行します。</p>
                    <p>生徒情報を削除を実行すると、欠課欠席の記録も削除されます。</p>
                    <form method="post" action="{{ route('students.destroyMany') }}">
                        @csrf
                        @method('delete')
                        <input class="btn btn-dark" type="submit" value="削除">
                    </form>
                </div>
            </div>
        </div>
</div>

<p class="description-head">◆生徒検索</p>

@endsection