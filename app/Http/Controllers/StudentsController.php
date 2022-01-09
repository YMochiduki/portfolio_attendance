<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Student;
use App\Http\Requests\StudentRequest;
use App\Attendance;
use App\Http\Requests\AttendanceRequest;
use App\User;
use App\Services\SearchService;
use App\Exports\StudentListExport;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $students = Student::all()->where('user_id' ,'=' ,\Auth::id());
        return view('student.search_form',[
            'students' =>$students
        ]);
    }
    
    
    public function search(Request $request, SearchService $service){
        $request->validate(['search' => ['require']]);
        $students = $service->searchStudents($request);
        return view('layouts.students_list',[
            'students' => $students
        ]);
    }

    public function searchList(Request $request, SearchService $service){
        $request->validate(['search' => ['require']]);
        $students = $service->searchStudents($request);
        return view('student.search_form',[
            'students' => $students
        ]);
    }
    
    public function import(Request $request){
        $request->validate(['excel_file'=>['required']]);
        
        $excel_file = $request->file('excel_file');
        $excel_file->store('excels');
        Excel::import(new StudentImport, $excel_file);
        return redirect()->action('StudentsController@index');
    }
    
    public function studentsListStyleExport(){
        return Excel::download(new StudentListExport, '生徒名簿様式.xlsx');
    }
    
    public function store(StudentRequest $request)
    {
        $user_id = \Auth::id();
        Student::create([
            'user_id' => $user_id,
            'year' => $request->year,
            'grade' => $request->grade,
            'class' => $request->class,
            'number' => $request->number,
            'name' => $request->name,
        ]);
        
        return back();
    }
    
    public function update(StudentRequest $request,$id){
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
    
    public function destroy($id){
        Student::find($id)->delete();
        return back();
    }
    
    public function destroyMany(){
        Student::query()->delete();
        return back();
    }
}
