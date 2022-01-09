<!--いらんかも。-->

@extends('layouts.students_list')
@section('search_form')
<!--<div>-->
<!--    <form class="form-inline" method="GET" action="{{ route('students.search') }}">-->
<!--    @csrf-->
<!--        <div class="form-group form-row">-->
<!--            <input type="number" name="year">年度-->
<!--            <select name="grade">-->
<!--                @php $curriculum_year = Auth::user()->curriculum_year @endphp-->
<!--                @for($i=1; $i <= $curriculum_year; $i++)-->
<!--                <option value="{{ $i }}">{{ $i }}年</option>    -->
<!--                @endfor-->
<!--            </select>-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <select name="class">-->
<!--                @php $class_count = Auth::user()->class_count @endphp-->
<!--                @for($i=1; $i <= $class_count; $i++)-->
<!--                    <option value="{{ $i }}">{{ $i }}組</option>    -->
<!--                @endfor-->
<!--            </select>-->
<!--        </div>-->
<!--            <input class="btn btn-info" type="submit" value="検索">-->
<!--    </form>-->
<!--    <a class="btn btn-outline-info" href="{{ route('attendance.index') }}">検索リセット</a>-->
<!--</div>-->

@endsection