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
        $students = Student::all();
        return view('attendance.index',[
            'students' =>$students
        ]);
    }
    
    public function search(Request $request){
        $request->validate(['search' => ['require']]);
        $students = '';
        $search = $request->search;
        $students = Student::where('grade', $request->grade)->where('class', $request->class)->get();

        return view('attendance.index',[
            'students' =>$students
        ]);

        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
