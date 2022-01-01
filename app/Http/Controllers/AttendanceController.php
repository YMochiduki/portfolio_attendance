<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Attendance;
use App\Http\Requests\AttendanceRequest;
use App\User;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $attendances = Attendance::all()->where('user_id','=',\Auth::id());
        return view('attendance.record',[
            'attendances' => $attendances
        ]);
    }
    
    public function search(Request $request){
        $request->validate(['search' => ['require']]);
        
        // $attendances = Attendance::where('user_id', \Auth::id())->where('date', $request->date)->where('grade', $request->grade)->where('class', $request->class)->get();
        $search = $request->search;


        $attendance = Attendance::where('user_id', \Auth::id())
            ->join('students', 'id', '=', 'attendances.students_id');
        
        return view('attendance.record',[
            'attendances' => $attendances
        ]);
    }

    public function create()
    {
        //
    }

    public function store(AttendanceRequest $request)
    {
        $data = $request->only([
                'students_id',
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
            'students_id',
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
