@extends('layouts.logged_in')
@section('content')
<div>
    {{--
    <form class="form-inline" method="GET" action="{{ route('attendance.search') }}">
    --}}
    <form method="GET" action="{{ route('attendance.search') }}">
        <div>
                <label>
                    <select name="year">
                    @for($i=2020; $i <= 2030; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>    
                    @endfor
                    </select>
                    年
                </label>
                <label>
                    <select name="month">
                    @for($i=1; $i <= 12; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>    
                    @endfor
                    </select>
                    月
                </label>
        </div>

        <div>
            
                <label>
                    <select name="year">
                    @for($i=1; $i <= 31; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>    
                    @endfor
                    </select>
                    年度
                </label>
                <label>
                    <select name="grade">
                    @for($i=1; $i <= 3; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>    
                    @endfor
                    </select>
                    学年
                </label>
                <label>
                    <select name="class">
                    @for($i=1; $i <= 3; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>    
                    @endfor
                    </select>
                    組
                </label>
                <label>
                    出席番号
                    <input type="number" name="number">
                </label>
        </div>
    
            <input class="btn btn-info" type="submit" value="検索">
            <a class="btn btn-outline-info" href="{{ route('attendance.index') }}">検索リセット</a>
    
    </form>
</div>
<div>
    <form method="post" action="/students_export">
        @csrf
        <input type="submit" value="生徒データダウンロード">
    </form>
</div>

{{--
@php
    $action = explode('@',Route::getCurrentRoute()->getActionName())[1]
@endphp
@if($action==='index')
    <p>条件を設定して検索してください。</p>
@else
--}}
    </form>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <tr>
                <th>欠課・欠席日</th>
                <th>学年</th>
                <th>組</th>
                <th>出席番号</th>
                <th>名前</th>
                <th>欠課・欠席</th>
                <th>連絡者</th>
            </tr>
        </thead>
        <tbody>
            
        @forelse($attendances as $attendance)
        <tr>
                <td>
                    {{ $attendance->date }}
                </td>
                <td>
                    {{ $attendance->students->grade }}年
                </td>
                <td>
                    {{ $attendance->students->class }}組
                </td>
                <td>
                    {{ $attendance->students->number }}番
                </td>
                <td>
                    {{ $attendance->students->name }}
                </td>
                <td>
                    {{ $attendance->absence_time }}<br>
                    @if($attendance->absence_time === "欠課")({{ $attendance->arrival_time }}までに到着)@endif
                </td>
                <td>
                    {{ $attendance->contact }}<br>
                </td>  
{{--                <!--<td>-->
                <!--    {{ $student->attendance }}-->
                <!--    @if($student->attendance === 0)-->
                <!--        <input type="submit" value="編集">-->
                <!--    @else-->
                <!--        <input type="submit" value="入力">-->
                <!--    @endif-->
                <!--</td>-->
--}}
{{--                <td>
                    <button class="btn btn-info" data-toggle="modal" data-target="#modal{{ $student->id }}">入力</button>
            
                    <div class="modal fade" id="modal{{ $student->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p>{{ $student->grade }}年{{ $student->class }}組{{ $student->number }}{{ $student->name }}</p>
                                    <button class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ route('attendance.store') }}">
                                    @csrf
                                        <input type="date" name="date" value="{{ old('date') }}">
                                        <div>
                                            <input type="radio" name="absence_time" value="欠課" @if(old('absence_time') === "欠課" )'checked' @endif
                                                        onclick="checkedTimeOff('arrival_time',this.checked);" >欠課
                                            <input type="radio" name="absence_time" value="欠席" @if(old('absence_time') === "欠席" )'checked' @endif>欠席
                                        </div>
                                        <div>
                                            <label>
                                                到着予定時間：
                                                <select id="arrival_time" name="arrival_time">
                                                    <option value=""></option>
                                                    <option value="1限目" @if(old('arrival_time') === "1限目" )'selected' @endif>1限目</option>
                                                    <option value="2限目" @if(old('arrival_time') === "2限目" )'selected' @endif>2限目</option>
                                                    <option value="3限目" @if(old('arrival_time') === "3限目" )'selected' @endif>3限目</option>
                                                    <option value="4限目" @if(old('arrival_time') === "4限目" )'selected' @endif>4限目</option>
                                                    <option value="5限目" @if(old('arrival_time') === "5限目" )'selected' @endif>5限目</option>
                                                    <option value="6限目" @if(old('arrival_time') === "6限目" )'selected' @endif>6限目</option>
                                                </select>までに到着予定
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                連絡者：
                                                <select name="contact">
                                                    <option value="保護者" @if(old('contact') === "保護者" )'selected' @endif>保護者</option>
                                                    <option valus="本人" @if(old('contact') === "本人" )'selected' @endif>本人</option>
                                                    <option value="その他" @if(old('contact') === "その他" )'selected' @endif>>その他（詳細は理由欄に記入）</option>
                                                </select>
                                            </label>
                                        </div>    
                                        <div>
                                            <label>
                                                理由:
                                                <textarea name="reason" rows="5" cols="40">{{ old('reason') }}</textarea>
                                            </label>
                                        </div>
                                        <input type="hidden" name="students_id" value="{{ $student->id }}">
                                        <input class="btn btn-info" type="submit" value="保存">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
--}}
            </tr>
            <tr>
                    
                <td colspan="8">
                    欠課・欠席理由：{{ $attendance->reason }}
                </td>

            </tr>
        </tr>
        </tbody>
        @empty
            <p>条件に一致する欠課・欠席。</p>
        @endforelse
    </table>
{{--
@endif
--}}
@endsection