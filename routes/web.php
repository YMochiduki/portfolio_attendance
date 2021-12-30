<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//欠席連絡入力
Route::resource('attendance', 'AttendanceController');
Route::get('students/search', 'AttendanceController@search')->name('students.search');

//名簿エディット
Route::resource('/admin', 'AdminController');

Route::post('/students_import','StudentsController@import')->name('import');

