<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/students.index', 'StudentsController@index')->name('students.index');
Route::resource('students', 'StudentsController')->only([
        'index', 'update', 'destroy'
    ]);
Route::post('/students_import','StudentsController@import');
Route::get('students/search', 'StudentsController@search')->name('students.search');
Route::get('students/searchList', 'StudentsController@searchList')->name('students.searchList');
Route::post('/attendances_export', 'AttendanceController@export')->name('export');

//欠席連絡入力
Route::resource('attendance', 'AttendanceController');
Route::get('attendance/search', 'AttendanceController@search')->name('attendance.search');
//名簿エディット
Route::resource('/admin', 'AdminController');


