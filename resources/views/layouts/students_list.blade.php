@extends('layouts.logged_in')
@section('content')

@yield('search_form')

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>学年</th>
                <th>組</th>
                <th>出席番号</th>
                <th>名前</th>
                <th>
                @php
                    $action = Request::route()->getName()
                @endphp
                @if($action==='attendance.index')
                    入力
                @else
                    編集・削除
                @endif
                </th>
            </tr>
        </thead>
        <tbody>
            
        @forelse($students as $student)
            <tr>
                <td>
                    {{ $student->grade }}年
                </td>
                <td>
                    {{ $student->class }}組
                </td>
                <td>
                    {{ $student->number }}番
                </td>
                <td>
                    {{ $student->name }}
                </td>
                <td>
                @php
                    $action = Request::route()->getName()
                @endphp
                @if($action==='attendance.index')
                    <button class="btn btn-info" data-toggle="modal" data-target="#modal{{ $student->id }}">入力</button>
                @else
                    <button class="btn btn-info" data-toggle="modal" data-target="#modal{{ $student->id }}Edit">編集</button>
                    <button class="btn btn-dark" data-toggle="modal" data-target="#modal{{ $student->id }}Delete">削除</button>
                @endif

                @if($action==='attendance.index')        
                    <!--欠課・欠席入力フォーム-->
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
                                        <input type="date" name="date"
                                            @if(old('date') !== null) value="{{old('date')}}"
                                            @else value="@php echo date('Y-m-d') @endphp"
                                            @endif >
                                        <div>
                                            <label><input type="radio" name="absence_time" value="欠課" @if(old('absence_time') === "欠課" )checked="checked" @endif
                                                        onClick="flg{{$student->id}}a(this.checked);"/>欠課</label>
                                            <label><input type="radio" name="absence_time" value="欠席" @if(old('absence_time') === "欠席" )checked="checked" @endif
                                                        onClick="flg{{$student->id}}b(this.checked);"/>欠席</label>
                                        </div>
                                        <div>
                                            <label>
                                                欠課時間：
                                                <select id="flg{{$student->id}}" name="arrival_time" >
                                                    <option value=""></option>
                                                    <option value="1限目" @if(old('arrival_time') === "1限目" )selected @endif>1限目</option>
                                                    <option value="2限目" @if(old('arrival_time') === "2限目" )selected @endif>2限目</option>
                                                    <option value="3限目" @if(old('arrival_time') === "3限目" )selected @endif>3限目</option>
                                                    <option value="4限目" @if(old('arrival_time') === "4限目" )selected @endif>4限目</option>
                                                    <option value="5限目" @if(old('arrival_time') === "5限目" )selected @endif>5限目</option>
                                                    <option value="6限目" @if(old('arrival_time') === "6限目" )selected @endif>6限目</option>
                                                </select>まで欠課予定
                                            <script>
                                                function flg{{$student->id}}a(ischecked){
                                                    if(ischecked == true){
                                                        document.getElementById("flg{{$student->id}}").disabled = false;
                                                    } else {
                                                        document.getElementById("flg{{$student->id}}").disabled = true;
                                                    }
                                                }

                                                function flg{{$student->id}}b(ischecked){
                                                    if(ischecked == true){
                                                        document.getElementById("flg{{$student->id}}").disabled = true;
                                                    } else {
                                                        document.getElementById("flg{{$student->id}}").disabled = false;
                                                    }
                                                }
                                            </script>
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                連絡者：
                                                <select name="contact">
                                                    <option value="保護者" @if(old('contact') === "保護者" )selected @endif>保護者</option>
                                                    <option valus="本人" @if(old('contact') === "本人" )selected @endif>本人</option>
                                                    <option value="その他" @if(old('contact') === "その他" )selected @endif>その他（詳細は理由欄に記入）</option>
                                                </select>
                                            </label>
                                        </div>    
                                        <div>
                                            <label>
                                                理由:
                                                <textarea name="reason" rows="5" cols="40">{{ old('reason') }}</textarea>
                                            </label>
                                        </div>
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <input class="btn btn-info" type="submit" value="保存">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!--生徒情報編集フォーム-->
                    <div class="modal fade" id="modal{{ $student->id }}Edit">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('students.update', $student->id) }}">
                                        @csrf
                                        @method('patch')
                                        <div>
                                            <input type="number" name="year" class="student-year" value="{{ $student->year }}">年度
                                            <select name="grade">
                                                @for($i=1; $i <=$curriculum_year; $i++)
                                                    <option value="{{ $i }}" @if($student->grade === $i )selected @endif>{{ $i }}年</option>    
                                                @endfor
                                            </select>
                                            <select name="class">
                                                @for($i=1; $i <= $class_count; $i++)
                                                    <option value="{{ $i }}" @if($student->class === $i )selected @endif>{{ $i }}組</option>    
                                                @endfor
                                            </select>
                                        </div
                                        <div>
                                            <label>
                                                出席番号<input type="number" name="number" value="{{ $student->number }}">番
                                            </label>
                                            <label>
                                                名前：<input type="text" name="name" value="{{ $student->name }}">
                                            </label>
                                            <input class="btn btn-info" type="submit" value="編集">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--生徒情報削除確認フォーム-->
                    <div class="modal fade" id="modal{{ $student->id }}Delete">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p>{{ $student->grade }}年{{ $student->class }}組{{ $student->number }}番{{ $student->name }}</p>
                                    <button class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>生徒情報を削除を実行します。</p>
                                    <p>生徒情報を削除を実行すると、欠課欠席の記録も削除されます。</p>
                                </div>
                            <form method="post" action="{{ route('students.destroy',$student->id) }}">
                                @csrf
                                @method('delete')
                                <input class="btn btn-dark" type="submit" value="削除">
                            </form>
                            </div>
                        </div>
                    </div>
                @endif
                </td>
            </tr>
        </tbody>
        @empty
            <p>生徒情報はありません</p>
        @endforelse
    </table>

@endsection