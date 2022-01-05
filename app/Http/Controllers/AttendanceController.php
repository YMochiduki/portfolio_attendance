<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Attendance;
use App\Http\Requests\AttendanceRequest;
use App\User;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\SearchService;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function export(){
        return Excel::download(new AttendanceExport, 'output_attendance_data.xlsx');
    }
    
    public function index()
    {
        $students = Student::all()->where('user_id' ,'=' ,\Auth::id());
        return view('attendance.index',[
            'students' =>$students,
        ]);
    }
    
    public function search(Request $request, SearchService $service)
    {

        $attendances = $service->searchAttendances($request);
        return $attendances;
        
        $date = $request->input('date');
        $grade = $request->input('grade');
        $class = $request->input('class');
        
        $attendances = Attendance::all()->where('user_id','=',\Auth::id())
            ->join('students', 'attendances.student_id', '=', 'students.id');
        
        // return $attendances;
        
        if($date !== ''){
            $attendances = $attendances->where('date' ,'=', $date);
        }
        if($grade !== ''){
            $attendances = $attendances->where($attendances->student->grade, '=', $grade);
        }


        
        // $search = $request->search;
        // if($search !== null){
        //     $query = Attendance::query()->join('users', 'user_id', '=', 'user.id');
        //     $query->orwhere('attendances.date', '=', $search->date ); 
        // }
        // $attendance = Attendance::where('user_id', \Auth::id())
        // $attendances = $query;
        return view('attendance.record',[
            'attendances' => $attendances
        ]);
    }

    public function create()
    {
        $attendances = Attendance::all()->where('user_id','=',\Auth::id());
        return view('attendance.record',[
            'attendances' => $attendances
        ]);
    }

    public function store(AttendanceRequest $request)
    {
        $data = $request->only([
                'student_id',
                'date',
                'absence_time',
                'arrival_time',
                'contact',
                'reason',
            ]);
        $data["user_id"]=\Auth::user()->id;
    
        Attendance::create($data);
        
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        
    }

    public function update(AttendanceRequest $request, $id)
    {
        $attendance = Attendance::find($id);
        
        $attendance->update($request->only([
            'date',
            'absence_time',
            'arrival_time',
            'contact',
            'reason',
        ]));
        
        return back();
    }

    public function destroy($id)
    {
        $attendance = Attendance::find($id);
        $attendance->delete();
        return back();
    }
    
    
}
