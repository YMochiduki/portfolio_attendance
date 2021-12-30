<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;


class StudentsController extends Controller
{
    public function import(Request $request){
        $request->validate(['excel_file'=>['required']]);
        
        $excel_file = $request->file('excel_file');
        $excel_file->store('excels');
        
        Excel::import(new StudentImport, $excel_file);
        return redirect()->action('AttendanceController@index');
    }
}
