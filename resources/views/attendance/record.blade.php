@extends('layouts.logged_in')
@section('content')

    <form method="GET" action="{{ route('attendances.search') }}">
        @csrf
            <label>
                欠課・欠席日
                <input type="date" name="date" value="@php echo date('Y-m-d') @endphp" class="date">
            </label>
            <label>
                学年
                <select name="grade">
                    <option value=""></option>
                @for($i=1; $i <= 3; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>    
                @endfor
                </select>
            </label>
            <label>
                組
                <select name="class">
                    <option value=""></option>
                @for($i=1; $i <= 3; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>    
                @endfor
                </select>
            </label>
            <input class="btn btn-info" type="submit" value="検索">
    </form>
    <div>
        <a class="btn btn-outline-info" href="{{ route('attendance.create') }}">検索リセット</a>
    </div>

<div>
    <form method="post" action="/attendances_export">
        @csrf
        <input type="submit" value="欠課・欠席情報ダウンロード" >
    </form>
</div>
@php
    $action = explode('@',Route::getCurrentRoute()->getActionName())[1]
@endphp
@if($action==='create')
    <p>条件を設定して検索してください。</p>
@else



<div class="table-responsive">
    
    @if($attendances->first() !== null)
        <p>検索対象日：{{ $attendances->first()->date }}</p>
    @endif
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <tr>
                <th class='grade'>学年</th>
                <th class="class">組</th>
                <th class="number">出席番号</th>
                <th class="name">名前</th>
                <th class="absence_time">欠課・欠席</th>
                <th class="contact">連絡者</th>
            </tr>
        </thead>
        <tbody>
        @forelse($attendances as $attendance)
        <tr>
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
                @if($attendance->absence_time === "欠課")({{ $attendance->arrival_time }}まで欠課)@endif
            </td>
            <td>
                {{ $attendance->contact }}<br>
            </td>  
        </tr>
        <tr>
                    
            <td colspan="5">
                欠課・欠席理由：{{ $attendance->reason }}
            </td>
            <td>
                <button class="btn btn-info" data-toggle="modal" data-target="#modal{{ $attendance->id }}">編集</button>
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
                                            <label><input type="radio" name="absence_time" value="欠課" @if($attendance->absence_time === "欠課") checked="checked"@endif
                                                onClick="flg{{$attendance->id}}a(this.checked);"/>欠課</label>
                                            <input type="radio" name="absence_time" value="欠席" @if($attendance->absence_time === "欠席" ) checked="checked"@endif
                                                onClick="flg{{$attendance->id}}b(this.checked);"/>欠席</label>
                                        </div>
                                        <div>
                                            <label>
                                                欠課時間：
                                                <select id="flg{{$attendance->id}}" name="arrival_time" @if($attendance->absence_time === "欠席" ) disabled  @endif>
                                                    <option value=""></option>
                                                    <option value="1限目" @if( $attendance->arrival_time === "1限目" )selected @endif>1限目</option>
                                                    <option value="2限目" @if( $attendance->arrival_time === "2限目" )selected @endif>2限目</option>
                                                    <option value="3限目" @if( $attendance->arrival_time === "3限目" )selected @endif>3限目</option>
                                                    <option value="4限目" @if( $attendance->arrival_time === "4限目" )selected @endif>4限目</option>
                                                    <option value="5限目" @if( $attendance->arrival_time === "5限目" )selected @endif>5限目</option>
                                                    <option value="6限目" @if( $attendance->arrival_time === "6限目" )selected @endif>6限目</option>
                                                </select>まで欠課予定
                                            <script>
                                                function flg{{$attendance->id}}a(ischecked){
                                                    if(ischecked == true){
                                                        document.getElementById("flg{{$attendance->id}}").disabled = false;
                                                    } else {
                                                        document.getElementById("flg{{$attendance->id}}").disabled = true;
                                                    }
                                                }

                                                function flg{{$attendance->id}}b(ischecked){
                                                    if(ischecked == true){
                                                        document.getElementById("flg{{$attendance->id}}").disabled = true;
                                                    } else {
                                                        document.getElementById("flg{{$attendance->id}}").disabled = false;
                                                    }
                                                }
                                            </script>
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
</div>
@endif

@endsection