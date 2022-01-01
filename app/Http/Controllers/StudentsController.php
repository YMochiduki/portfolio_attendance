<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Student;
use App\Attendance;
use App\Http\Requests\AttendanceRequest;
use App\User;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $students = Student::all()->where('user_id' ,'=' ,\Auth::id());
        return view('students.index',[
            'students' =>$students
        ]);
    }

    public function search(Request $request){
        $request->validate(['search' => ['require']]);
        $students = '';
        $search = $request->search;
        $students = Student::where('grade', $request->grade)->where('class', $request->class)->get();

        return view('students.index',[
            'students' =>$students
        ]);
    }

    public function import(Request $request){
        $request->validate(['excel_file'=>['required']]);
        
        $excel_file = $request->file('excel_file');
        $excel_file->store('excels');
        // return var_dump($excel_file);
        
        Excel::import(new StudentImport, $excel_file);
        return redirect()->action('StudentsController@index');
    }
    
    public function destroyOne($id){
        Student::where('id', 1)->delete();
        return back();
    }
    
    public function destroyMany(Request $request){
        Product::where('id', 1)->delete();
    }
}
