@extends('layouts.logged_in')
@section('content')
<div>
    <form method="GET" action="{{ route('attendances.search') }}">
        @csrf
        <div>
            
                <label>
                    欠課・欠席日
                    <input type="date" name="date">
                </label>
            
                <label>
                    <select name="grade">
                        <option value=""></option>
                    @for($i=1; $i <= 3; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>    
                    @endfor
                    </select>
                    学年
                </label>
                <label>
                    <select name="class">
                        <option value=""></option>
                    @for($i=1; $i <= 3; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>    
                    @endfor
                    </select>
                    組
                </label>
        </div>
            <input class="btn btn-info" type="submit" value="検索">
        </form>
            <a class="btn btn-outline-info" href="{{ route('attendance.create') }}">検索リセット</a>
</div>
<div>
    <form method="post" action="/attendances_export">
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
                {{ $attendance->student->grade }}年
            </td>
            <td>
                {{ $attendance->student->class }}組
            </td>
            <td>
                {{ $attendance->student->number }}番
            </td>
            <td>
                {{ $attendance->student->name }}
            </td>
            <td>
                {{ $attendance->absence_time }}<br>
                @if($attendance->absence_time === "欠課")({{ $attendance->arrival_time }}までに到着)@endif
            </td>
            <td>
                {{ $attendance->contact }}<br>
            </td>  
        </tr>
        <tr>
                    
            <td colspan="6">
                欠課・欠席理由：{{ $attendance->reason }}
            </td>
            <td>
                <button class="btn btn-info" data-toggle="modal" data-target="#modal{{ $attendance->id }}">編集</button>
            </td>
        </tr>
    
                    <div class="modal fade" id="modal{{ $attendance->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p>{{ $attendance->student->grade }}年{{ $attendance->student->class }}組{{ $attendance->student->number }}{{ $attendance->student->name }}</p>
                                    <button class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ route('attendance.update', $attendance->id) }}">
                                    @csrf
                                    @method('patch')
                                        <input type="date" name="date" value={{ $attendance->date }}>
                                        <div>
                                            <input type="radio" name="absence_time" value="欠課" @if($attendance->absence_time === "欠課") checked="checked" @endif
                                                onclick="checkedTimeOff('arrival_time',this.checked);" >欠課
                                            <input type="radio" name="absence_time" value="欠席" @if($attendance->absence_time === "欠席" ) checked="checked" @endif>欠席
                                
                                        </div>
                                        <div>
                                            <label>
                                                到着予定時間：
                                                <select id="arrival_time" name="arrival_time">
                                                    <option value=""></option>
                                                    <option value="1限目" @if( $attendance->arrival_time === "1限目" )selected @endif>1限目</option>
                                                    <option value="2限目" @if( $attendance->arrival_time === "2限目" )selected @endif>2限目</option>
                                                    <option value="3限目" @if( $attendance->arrival_time === "3限目" )selected @endif>3限目</option>
                                                    <option value="4限目" @if( $attendance->arrival_time === "4限目" )selected @endif>4限目</option>
                                                    <option value="5限目" @if( $attendance->arrival_time === "5限目" )selected @endif>5限目</option>
                                                    <option value="6限目" @if( $attendance->arrival_time === "6限目" )selected @endif>6限目</option>
                                                </select>までに到着予定
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                連絡者：
                                                <select name="contact">
                                                    <option value="保護者" @if($attendance->contact === "保護者" )selected @endif>保護者</option>
                                                    <option valus="本人" @if($attendance->contact === "本人" )selected @endif>本人</option>
                                                    <option value="その他" @if($attendance->contact === "その他" )selected @endif>その他（詳細は理由欄に記入）</option>
                                                </select>
                                            </label>
                                        </div>    
                                        <div>
                                            <label>
                                                理由:
                                                <textarea name="reason" rows="5" cols="40">{{ $attendance->reason }}</textarea>
                                            </label>
                                        </div>
                                        <input type="hidden" name="student_id" value="{{ $attendance->student_id }}">
                                        <input class="btn btn-info" type="submit" value="編集反映">
                                    </form>
                                    <form method="post" action="{{ route('attendance.destroy',$attendance->id) }}">
                                        @csrf
                                        @method('delete')
                                        <input class="btn btn-dark" type="submit" value="削除">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
        </tr>
        </tbody>
        @empty
            <p>条件に一致する欠課・欠席はありません。</p>
        @endforelse
    </table>
{{--
@endif
--}}
@endsection