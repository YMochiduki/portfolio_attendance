@extends('layouts.logged_in')
@section('content')
<div>
    
    <form class="form-inline" method="GET" action="{{ route('students.searchList') }}">
    
        <div class="form-group form-row">
            <select name="grade">
                @php $curriculum_year = Auth::user()->curriculum_year @endphp
                @for($i=1; $i <= $curriculum_year; $i++)
                    <option value="{{ $i }}">{{ $i }}年</option>    
                @endfor
            </select>
        </div>
        <div class="form-group">
            <select name="class">
                @php $class_count = Auth::user()->class_count @endphp
                @for($i=1; $i <= $class_count; $i++)
                    <option value="{{ $i }}">{{ $i }}組</option>    
                @endfor
            </select>
        </div>
        <input class="btn btn-info" type="submit" value="検索">
    </form>
    <a class="btn btn-outline-info" href="{{ route('students.index') }}">検索リセット</a>
</div>

<div>
    <button class="btn btn-info" data-toggle="modal" data-target="#modal">生徒新規登録</button>
<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
                <form method="POST" action="{{ route('students.store')}}">
            @csrf
                    <td> 
                        <input type="number" name="year" class="student-year" value="{{ old('year') }}">年度
                    </td>
                    <td><label>
                        <select name="grade" class="student-edit">
                            @for($i=1; $i <=$curriculum_year; $i++)
                                <option value="{{ $i }}" @if(old('grade') === $i )selected @endif>{{ $i }}年</option>    
                            @endfor
                        </select>
                    </label></td>
                    <td>
                        <select name="class">
                            @for($i=1; $i <= $class_count; $i++)
                                <option value="{{ $i }}" @if(old('class') === $i )selected @endif>{{ $i }}組</option>    
                            @endfor
                        </select>
                    </td>
                    <td>
                        <input type="number" name="number" class="student-edit" value="{{ old('number') }}">番
                    </td>
                    <td>
                        <input type="text" name="name" class="student-name" value="{{ old('name') }}">
                    </td>
                    <td>
                        <input class="btn btn-info" type="submit" value="追加">
                    </td>
                </form>
            </div>
        </div>
    </div>
</div>

    <form method="post" action="/students_import" enctype="multipart/form-data">
        @csrf
        <input class="excel" type="file" name="excel_file" ><br>
        <input class="btn btn-info" type="submit" value="インポート">
    </form>
    <form method="post" action="{{ route('students.destroyMany') }}">
        @csrf
        @method('delete')
        <input class="btn btn-dark" type="submit" value="削除">
    </form>
    
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>年度</th>
                <th>学年</th>
                <th>組</th>
                <th>出席番号</th>
                <th>名前</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
        </thead>
        
        <tbody>
        @forelse($students as $student)
            <tr>
                <form method="POST" action="{{ route('students.update', $student->id) }}">
                @csrf
                @method('patch')
                    <td> 
                        <input type="number" name="year" value="{{ $student->year }}" class="student-year">年度
                    </td>
                    <td>
                        <select name="grade" class="student-edit">
                            @for($i=1; $i <=$curriculum_year; $i++)
                                <option value="{{ $i }}" @if($student->grade === $i )selected @endif>{{ $i }}年</option>    
                            @endfor
                        </select>
                    </td>
                    <td>
                        <select name="class" class="student-edit">
                            @for($i=1; $i <=$class_count; $i++)
                                <option value="{{ $i }}" @if($student->class === $i )selected @endif>{{ $i }}組</option>    
                            @endfor
                        </select>
                    </td>
                    <td>
                        <input type="number" name="number" value="{{ $student->number }}"  class="student-edit">番
                    </td>
                    <td>
                        <input type="text" name="name" value="{{ $student->name }}"  class="student-name">
                    </td>
                    <td>
                        <input class="btn btn-info" type="submit" value="編集反映">
                    </td>
                </form>                        
                    <td>
                        <button class="btn btn-info" data-toggle="modal" data-target="#modal-D">削除</button>
                    </td>
                <div class="modal fade" id="modal-D">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p>{{ $student->grade }}年{{ $student->class }}組{{ $student->number }}{{ $student->name }}</p>
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
            </tr>
        </tbody>
        @empty
            <p>生徒情報はありません</p>
        @endforelse
    </table>

@endsection