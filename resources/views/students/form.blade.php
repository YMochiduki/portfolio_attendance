@extends('layouts.logged_in')
@section('content')
<div>
    
    <form class="form-inline" method="GET" action="{{ route('students.search') }}">
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
        <div class="form-group">
            欠課・欠席有のみ<input type="checkbox" name="attendance">
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
@endsection