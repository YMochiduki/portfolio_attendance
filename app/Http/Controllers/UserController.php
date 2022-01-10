<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = \Auth::user();
        return view('user.index',[
            'user' => $user
        ]);
    }

        public function update(UserRequest $request)
    {
        \Auth::user()->update($request->only([
            'name',
            'email',
            'curriculum_year',
            'class_count'
        ]));
        return back();
    }
}
