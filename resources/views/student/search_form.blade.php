@extends('layouts.students_list')
@section('search_form')

@php $curriculum_year = Auth::user()->curriculum_year @endphp
@php $class_count = Auth::user()->class_count @endphp

<div>
    <button class="btn btn-info" data-toggle="modal" data-target="#modal">生徒新規登録</button>
<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
                <form method="POST" action="{{ route('students.store')}}">
            @csrf
                    <label>
                        <input type="number" name="year" class="student-year" value="{{ old('year') }}">年度
                    </label>
                    <label>
                        <select name="grade" class="student-edit">
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
                    <input type="number" name="number" class="student-edit" value="{{ old('number') }}">番
                    <input type="text" name="name" class="student-name" value="{{ old('name') }}">
                    <input class="btn btn-info" type="submit" value="追加">
                </form>
            </div>
        </div>
    </div>
</div>
<div>
    <form method="post" action="/students_import" enctype="multipart/form-data">
        @csrf
        <input class="excel" type="file" name="excel_file" ><br>
        <input class="btn btn-info" type="submit" value="インポート">
    </form>
</div>
<div>
    <form method="post" action="{{ route('students.ListStyleExport') }}">
        @csrf
        <input type="submit" value="名簿様式ダウンロード">
    </form>
</div>
<div>
    <form method="post" action="{{ route('students.destroyMany') }}">
        @csrf
        @method('delete')
        <input class="btn btn-dark" type="submit" value="削除">
    </form>
</div>

@endsection