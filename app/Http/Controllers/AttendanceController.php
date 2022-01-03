<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Attendance;
use App\Http\Requests\AttendanceRequest;
use App\User;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;

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
            'students' =>$students
        ]);
    }
    
    public function search(Request $request){
        $request->validate(['search' => ['require']]);
        
        // $attendances = Attendance::where('user_id', \Auth::id())->where('date', $request->date)->where('grade', $request->grade)->where('class', $request->class)->get();
        $search = $request->search;
        $attendance = Attendance::where('user_id', \Auth::id())
            ->join('students', 'id', '=', 'attendances.student_id');
        
        return view('attendance.record',[
            'attendances' => $attendances
        ]);
    }

    public function create()
    {
        $attendances = Attendance::all()->where('user_id','=',\Auth::id());
            // ->join('students','attendances.student_id', '=', 'students.id'); 
        // return $attendances;
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
            'student_id',
            'date',
            'absence_time',
            'arrival_time',
            'contact',
            'reason',
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    
}
