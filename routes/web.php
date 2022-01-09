<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('students', 'StudentsController')->only([
        'index', 'store','update', 'destroy'
    ]);
Route::post('students_import','StudentsController@import');
Route::post('studentsListStyle_export', 'StudentsController@studentsListStyleExport')->name('students.ListStyleExport');
Route::get('students/search', 'StudentsController@search')->name('students.search');
Route::get('students/searchList', 'StudentsController@searchList')->name('students.searchList');
Route::delete('students', 'StudentsController@destroyMany')->name('students.destroyMany');


Route::resource('attendance', 'AttendanceController')->only([
        'index', 'create', 'store', 'update', 'destroy'
    ]);
Route::post('attendances_export', 'AttendanceController@export')->name('export');
Route::get('attendances/search', 'AttendanceController@search')->name('attendances.search');
//名簿エディット
Route::get('user', 'UserController@index')->name('user.index');
Route::patch('user','UserController@update')->name('user.update');


