@extends('layouts.logged_in')
@section('content')
<div>
    
    <form class="form-inline" method="GET" action="{{ route('students.searchList') }}">
    
        <div class="form-group form-row">
            <select name="grade">
                <option value="1">1年</option>
                <option value="2">2年</option>
                <option value="3">3年</option>
            </select>
        </div>
        <div class="form-group">
            <select name="class">
                <option value="1">1組</option>
                <option value="2">2組</option>
                <option value="3">3組</option>
            </select>
        </div>
        <input class="btn btn-info" type="submit" value="検索">
    </form>
    <a class="btn btn-outline-info" href="{{ route('students.index') }}">検索リセット</a>
</div>

    <form method="post" action="/students_import" enctype="multipart/form-data">
        @csrf
        <input type="file" name="excel_file" ><br>
        <input type="submit" value="インポート">
    </form>
    
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>年度</th>
                <th>学年</th>
                <th>組</th>
                <th>出席番号</th>
                <th>名前</th>
                <th>編集・削除</th>
            </tr>
        </thead>
        
        <tbody>
        @forelse($students as $student)
            <tr>
                <form method="POST" action="{{ route('students.update', $student->id) }}">
                @csrf
                @method('patch')
                    <td> 
                        <input type="number" name="year" value="{{ $student->year }}">年度
                    </td>
                    <td>
                        <input type="number" name="grade" value="{{ $student->grade }}">年
                    </td>
                    <td>
                        <input type="number" name="class" value="{{ $student->class }}">組
                    </td>
                    <td>
                        <input type="number" name="number" value="{{ $student->number }}">番
                    </td>
                    <td>
                        <input type="text" name="name" value="{{ $student->name }}">
                    </td>
                    <td>
                        <input class="btn btn-info" type="submit" value="編集反映">
                    </td>
                </form>
            </tr>
        </tbody>
        @empty
            <p>生徒情報はありません</p>
        @endforelse
    </table>

@endsection