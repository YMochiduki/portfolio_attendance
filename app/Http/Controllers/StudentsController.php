<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Student;
use App\Attendance;
use App\Http\Requests\AttendanceRequest;
use App\User;
use App\Services\SearchService;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $students = Student::all()->where('user_id' ,'=' ,\Auth::id());
        return view('student.index',[
            'students' =>$students
        ]);
    }
    

    public function search(Request $request, SearchService $service){
        $request->validate(['search' => ['require']]);
        $students = $service->searchStudents($request);
        return view('attendance.index',[
            'students' =>$students
        ]);
    }

    public function searchList(Request $request, SearchService $service){
        $request->validate(['search' => ['require']]);
        $students = $service->searchStudents($request);
        return view('student.index',[
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
    
    public function update(Request $request,$id){
        $student = Student::find($id);
        $student->update($request->only([
                'year',
                'grade',
                'class',
                'number',
                'name',
            ]));

        return back();
    }
    
    public function destroyOne($id){
        Student::where('id', 1)->delete();
        return back();
    }
    
    public function destroyMany(Request $request){
        Product::where('id', 1)->delete();
    }
}
